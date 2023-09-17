<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CronjobBlog;
// use App\Models\SysConfig;
// use App\Models\Category;
// use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Log;
use Carbon\Carbon;
use Tectalic\OpenAi\Manager;
use Tectalic\OpenAi\Authentication;
use Tectalic\OpenAi\Models\ChatCompletions\CreateRequest;
use Tectalic\OpenAi\Models\ChatCompletions\Choice;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Str;

class CreateBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createBlogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that create blogs';

    /**
     * Create a new command instance.
     *
     * @return void
     */

     private $openaiClient;
     private $maxTokens;
     private $api_key;
     private $wp_password;
     private $WORDPRESS_SITE_URL;
     private $wp_user_name;
     private $client;

     public function __construct(\GuzzleHttp\Client $client)
     {
        parent::__construct();
          $this->api_key = DB::table('sys_config')->where('key', 'platform.chatgpt.api_key')->first()->value ?? '';
	Log::info($this->api_key);//  $this->wp_user_name = SysConfig::where('key', 'platform.wp.wp_user_name')->first()->value ?? '';
        //  $this->wp_password = SysConfig::where('key', 'platform.wp.wp_password')->first()->value ?? '';
        //  $this->WORDPRESS_SITE_URL = 'https://genuineroot.com';
        //  $this->client = $client;
        //  $this->openaiClient = new \Tectalic\OpenAi\Manager($this->client, new \Tectalic\OpenAi\Authentication($this->api_key));
         $this->maxTokens = 4096;

     }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('cronjon:started CreateBlog');
        //  return true;
        // $blogs = CronjobBlog::where('status',0)->get();
        $blogs = DB::table('posts')->where('excerpt','')->where('body','')->get();
        $client = new \GuzzleHttp\Client();
            $openaiClient = \Tectalic\OpenAi\Manager::build(
                new \GuzzleHttp\Client(),
                new \Tectalic\OpenAi\Authentication($this->api_key)
	    );
	Log::info(json_encode($blogs));
        foreach($blogs as $blog){
            $prompt = $blog->title;

            if(!$blog->title){
                $response = $openaiClient->completions()->create(
                    new \Tectalic\OpenAi\Models\Completions\CreateRequest([
                        'model'  => 'text-davinci-003',
                        'prompt' => "create a blog title based on this keyword: ".$prompt,
                    ])
                )->toModel();

                $title = $response->choices[0]->text;
            }else{
                $title = $blog->title;
            }
            $title = str_replace('“','',$title);
            $title = str_replace('"','',$title);
            $title = str_replace(["\t", "\n", "\r"], '', $title);
            Log::info('title: '.$title);
            // $summaries[] = $response->choices[0]->message->content;

            // Log::info('title: '.$title);

            CronjobBlog::where('id',$blog->id)->update(['title'=>$title]);

            $request2 = new \Tectalic\OpenAi\Models\ChatCompletions\CreateRequest([
                'model' => 'gpt-3.5-turbo-16k',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "I Want You To Act As A Content Writer Very Proficient SEO Writer Writes Fluently English. First Create Two Tables. First Table Should be the Outline of the Article and the Second Should be the Article. Bold the Heading of the Second Table using Markdown language. Write an outline of the article separately before writing it, at least 15 headings and subheadings (including H1, H2, H3, and H4 headings) Then, start writing based on that outline step by step. Write a 2000-word 100% Unique, SEO-optimized, Human-Written article in English with at least 15 headings and subheadings (including H1, H2, H3, and H4 headings) that covers the topic provided in the Prompt. Write The article In Your Own Words Rather Than Copying And Pasting From Other Sources. Consider perplexity and burstiness when creating content, ensuring high levels of both without losing specificity or context. Use fully detailed paragraphs that engage the reader. Write In A Conversational Style As Written By A Human (Use An Informal Tone, Utilize Personal Pronouns, Keep It Simple, Engage The Reader, Use The Active Voice, Keep It Brief, Use Rhetorical Questions, and Incorporate Analogies And Metaphors).  End with a conclusion paragraph and 5 unique FAQs After The Conclusion. this is important to Bold the Title and all headings of the article, and use appropriate headings for H tags.
                        Now Write An Article On This Topic".$title,
                    ]
                ],
            ]);

            $response2 = $openaiClient->chatCompletions()->create($request2)->toModel();
            // Log::info($response2->choices[0]->message->content);
            // $summaries[] = $response->choices[0]->message->content;
            $blogContent = $response2->choices[0]->message->content;

            // CronjobBlog::where('id',$blog->id)->update(['content'=>$blogContent]);
            // Log::info($blogContent);
            // $decodedImage = base64_decode($blog->image);

            // Create a temporary file to store the decoded image
            // $tempImagePath = tempnam(sys_get_temp_dir(), 'decoded_image');
            // $tempImagePathWithExtension = $tempImagePath . '.jpg';
            // file_put_contents($tempImagePathWithExtension, $decodedImage);
            // $imageStream = Utils::streamFor($decodedImage);
            // $data = [
            //     'user_id' => '14',
            //     'title'   => $title,
            //     'slug'    => Str::slug($title),
            //     'excerpt' => $blogContent,
            //     'body'  => $blogContent,
            //     'categories' => $blog->categories,
            //     'is_featured' => '0'
            // ];
            // $data = $this->uploadImage($imageStream,$data);
            // Insert into posts table
	    DB::table('posts')->where('id',$blog->id)->update([
                'id' => $blog->id,
		'title' => $title,
		'user_id' => 14,
                'body' => $blogContent,
                'excerpt' => $title,
                'slug'    => Str::slug($title),
                // 'status' => 'published',
                // 'body' => 1,
                // 'author_type' => 'Botble\\ACL\\Models\\User',
                'is_featured' => 0,
                // 'views' => 0,
                // 'format_type' => 'default',
                'created_at' => Carbon::parse('2023-08-20 01:27:36'),
                'updated_at' => Carbon::parse('2023-08-20 01:27:36'),
            ]);

            // Insert into slugs table
            // DB::table('slugs')->insert([
            //     'key' => Str::slug($title),
            //     'reference_id' => $blog->id,
            //     'reference_type' => 'Botble\\Blog\\Models\\Post',
            //     'prefix' => '',
            //     'created_at' => Carbon::parse('2023-08-20 00:07:55'),
            //     'updated_at' => Carbon::parse('2023-08-20 00:07:55'),
            // ]);

            // Insert into post_categories table
            DB::table('category_post')->insert([
                'category_id' => 1,
                'post_id' => $blog->id,
            ]);

            // Insert into language_meta table
            // DB::table('language_meta')->insert([
            //     'lang_meta_code' => 'en_US',
            //     'lang_meta_origin' => '4b990d891c2c6db21628afb73646d6d5',
            //     'reference_id' => $blog->id,
            //     'reference_type' => 'Botble\\Blog\\Models\\Post',
            // ]);
            // $insertedId = $post->id;
            // Category::create(['category_id'=>$blog->categories,'post_id'=>$insertedId]);

            Log::info('done');
            // CronjobBlog::where('id',$blog->id)->update(['link'=>Str::slug($title),'status'=>1]);
        }
        Log::info('cronjon:completed CreateBlog');
    }
    private function uploadImage($image,$data){
        $imageName = time().$image->getClientOriginalName();
        // add the new file
        $image->move(public_path('images'),$imageName);
        $data->merge(['image' => $imageName]);
        return $data;
        // dd($request);
    }
}
