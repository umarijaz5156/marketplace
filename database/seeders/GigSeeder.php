<?php

namespace Database\Seeders;

use App\Enums\ImageType;
use App\Enums\PackageType;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\Seller\Gig;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Seller\GigDetail;
use App\Models\Seller\GigFaq;
use App\Models\Seller\GigImage;
use App\Models\Seller\GigPackage;
use App\Models\Seller\GigRequirement;
use App\Models\Seller\GigService;
use App\Models\Seller\GigStat;
use App\Models\Seller\Seller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $seller = User::where('is_seller', true)->first();
        $seller = Seller::inRandomOrder()->first();
       
        // first gig
        $gig1 = Gig::create([
            'is_approved' => true,
            'package_type' => 0,
            'seller_id' => $seller->id, 
        ]);

        $gig1Detail = GigDetail::create([
            'title' => 'I will clone, redesign wordpress website with elementor pro',
            'description' => "<div>About This Gig</div><div><br><strong>Note : Must Contact Me Before Placing an Order to avoid cancellation</strong><br><strong>Gig Service: clone, redesign wordpress, revamp wordpress website with elementor pro</strong><br><br>Do you feel like your website UI design looks unprofessional, outdated, or unresponsive?<br>If so, then you don't need to scroll anymore. I'm the best choice for you.<br><br>I have 3 years of immense experience in WordPress development, I'm a pro expert in <strong>Elementor Pro, WP Bakery, and Divi Page Builder.</strong><br><br>I will clone, redesign wordpress website, and revamp wordpress web-site with elementor pro, divi page builder and other popular premium plugins.<br><br>I'd love to create all kinds of professional WordPress landing pages using amazing page builders (<strong><em>Elementor Pro</em></strong> \ <strong><em>Divi</em></strong> \ <strong><em>Bakery</em></strong> \ <strong><em>Oxygen </em></strong><strong>\ Brave)</strong><br><br><strong>Services i offer here:</strong><br>Clone / Duplicate / redesign website<br>Rebuild / revamp wordpress we_bsite<br>Convert Figma, PSD, XD to elementor pro<br>Pixel perfect all devices responsive<br>Minimal design<br>Fast speed loading<br>Create full new site from scratch<br>Update PHP version, plugins and theme<br><br><strong>Bonus:</strong><br>1 Months of free support<br>Free Basic Speed Optimization<br><br><strong>Why choose me?</strong><br>24/7 free support<br>Free revisions</div>",
            'slug' => 'i-will-clone-redesign-wordpress-website-with-elementor-pro',
            'gig_id' => $gig1->id,
        ]);
        


        $gig1Image = GigImage::create([
            'image_path' => '1669015276_Screenshot 2022-11-21 at 11-04-39 5052e62a1357c71ca3f4a66f832ef29a8f3e55dd.webp (WEBP Image 680 × 453 pixels).png',
            'image_type' => ImageType::Main->value,
            'gig_id' => $gig1->id,
        ]);
    

        $gig1Image2 = GigImage::create([
            'image_path' => '1669015276_Screenshot 2022-11-21 at 11-04-21 661dd8dc716a278ec2a2f32579478140c130e9ce.webp (WEBP Image 680 × 453 pixels).png',
            'image_type' => ImageType::Additional->value,
            'gig_id' => $gig1->id,
        ]);
    

        $gig1Image3 = GigImage::create([
            'image_path' => '1669015276_Screenshot 2022-11-21 at 11-02-22 137bdea3e8fe22b113b19a1c0d26a78124570657.webp (WEBP Image 680 × 453 pixels).png',
            'image_type' => ImageType::Additional->value,
            'gig_id' => $gig1->id,
        ]);
       

        $gig1->tags()->attach(Tag::find(1));
        $gig1->tags()->attach(Tag::find(3));
        $gig1->tags()->attach(Tag::find(5));

        $gig1->gigStat()->save(new GigStat);

        $gig1Package = GigPackage::create([
            'type' => PackageType::Basic->value,
            'package_name' => 'Small - redesign wordpress website',
            'package_description' => 'clone website, revamp wordpress website, redesign wordpress website with elementor pro, 4-5 sections',
            'price' => 5,
            'delivery_days' => 1,
            'gig_id' => $gig1->id,
        ]);


        $gig1PackageService1 = GigService::create([
            'name' => '1Page'
        ]);
        $gig1Package->services()->attach($gig1PackageService1);

        $gig1PackageService2 = GigService::create([
            'name' => 'Design Customization'
        ]);
        $gig1Package->services()->attach($gig1PackageService2);

        $gig1PackageService3 = GigService::create([
            'name' => 'Responsive'
        ]);
        $gig1Package->services()->attach($gig1PackageService3);

        $gig1Faq = GigFaq::create([
            'question' => 'What do you need to clone, redesign wordpress or revamp wordpress wesbite?',
            'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
            'gig_id' => $gig1->id,
        ]);
      

        $gig1Faq = GigFaq::create([
            'question' => 'Can you customize, redesign or revamp wordpress website which is already existing?',
            'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
            'gig_id' => $gig1->id,
        ]);
      

        $gig1Faq = GigFaq::create([
            'question' => 'Do you create new wordpress website or elementor pro website ?',
            'answer' => 'Yes, I will create a brand-new WordPress website for you if you have not created yet. ',
            'gig_id' => $gig1->id,
        ]);
      

        $gig1Req = GigRequirement::create([
            'requirement' => 'Send me complete Requirements',
            'gig_id' => $gig1->id,
        ]);

        $seller->increment('gigs_count');

        // gig 2
        $seller = Seller::inRandomOrder()->first();
        $gig1 = Gig::create([
            'is_approved' => true,
            'package_type' => 1,
            'seller_id' => $seller->id, 
        ]);

        $gig1Detail = GigDetail::create([
            'title' => 'I will repair wordpress, fix errors and issues with support',
            'description' => "<div><em>Dear Respected Client,&nbsp;</em></div><div><br></div><div><strong>***Please Send me a Message before placing the order and complete instructions of work to be done so that to avoid any misunderstandings,.***&nbsp;</strong></div><div><br></div><div><br></div><div>Do you have any issues with your WordPress &amp; WooCommerce website which is affecting your business? Do not worry you have clicked on the right service!!</div><div><br></div><div>I am full stack developer with more than 6 years experience in Web developing and programming.</div><div><br></div><div>I have worked in more than 100 sites which gave me experience and the knowledge about problems, issues and how to fix them so fast.</div><div><br></div><div><strong>My Services:&nbsp;</strong></div><div><br></div><ul><li>Fix your website HTML and CSS issue</li><li>Fix responsive Problem &amp; errors on your Website</li><li>Fix your WordPress Plugins and Theme error</li><li>Fix any WooCommerce &amp; E-commerce issue on your Wordpress Website</li><li>Customisation and developing your theme and plugins in Wordpress</li><li>Fix any Bug, Issue and Error in Your WordPress Website</li></ul><div><br></div><div><strong>Why Hire Me ?</strong></div><div><br></div><ul><li>Fast Delivery</li><li>Unlimited Revisions</li><li>100% Work to be done according to your requirements</li><li>100% Satisfaction</li></ul><div><br></div><div><br></div><div><strong>Custom Gigs are always available, send me message for the details. Feel free to message me anytime&nbsp;</strong></div>",
            'slug' => 'i-will-repair-wordpress-fix-errors-and-issues-with-support',
            'gig_id' => $gig1->id,
        ]);

        $gig1Image = GigImage::create([
            'image_path' => '1669017050_Screenshot 2022-11-21 at 12-50-10 753abcd0a67987086e0e8c3542fc60ef34549924.webp (WEBP Image 680 × 411 pixels).png',
            'image_type' => ImageType::Main->value,
            'gig_id' => $gig1->id,
        ]);
    

        $gig1Image2 = GigImage::create([
            'image_path' => '1669017050_Screenshot 2022-11-21 at 12-49-24 d87822427f078b1d86c3738cd0e8e800044d0b99.webp (WEBP Image 680 × 420 pixels).png',
            'image_type' => ImageType::Additional->value,
            'gig_id' => $gig1->id,
        ]);
    

        $gig1Image3 = GigImage::create([
            'image_path' => '1669017050_Screenshot 2022-11-21 at 12-49-24 d87822427f078b1d86c3738cd0e8e800044d0b99.webp (WEBP Image 680 × 420 pixels).png',
            'image_type' => ImageType::Additional->value,
            'gig_id' => $gig1->id,
        ]);
       
        $gig1->tags()->attach(Tag::find(1));
        $gig1->tags()->attach(Tag::find(3));
        $gig1->tags()->attach(Tag::find(5));

        // $gigStat = new GigStat(['gig_id' => $gig1->id]);
        $gig1->gigStat()->save(new GigStat);

        $gig1Package = GigPackage::create([
            'type' => PackageType::Basic->value,
            'package_name' => 'Basic Wordpress Fix/Customize',
            'package_description' => 'I will fix 1 small issue and Customize 1 small thing ',
            'price' => 5,
            'delivery_days' => 1,
            'gig_id' => $gig1->id,
        ]);

        $gig1Package = GigPackage::create([
            'type' => PackageType::Standard->value,
            'package_name' => 'Standard Wordpress Fix/Customize ',
            'package_description' => 'I will fix 2-3 small issues and Customize 2-3 small things',
            'price' => 10,
            'delivery_days' => 3,
            'gig_id' => $gig1->id,
        ]);

        $gig1Package = GigPackage::create([
            'type' => PackageType::Advance->value,
            'package_name' => 'Pro WordPress Theme Customisation',
            'package_description' => 'I will do few customisation in your WordPress Website',
            'price' => 15,
            'delivery_days' => 5,
            'gig_id' => $gig1->id,
        ]);

     

        $gig1Faq = GigFaq::create([
            'question' => 'What do you need to clone, redesign wordpress or revamp wordpress wesbite?',
            'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
            'gig_id' => $gig1->id,
        ]);
      

        $gig1Faq = GigFaq::create([
            'question' => 'Can you customize, redesign or revamp wordpress website which is already existing?',
            'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
            'gig_id' => $gig1->id,
        ]);
      

        $gig1Faq = GigFaq::create([
            'question' => 'Do you create new wordpress website or elementor pro website ?',
            'answer' => 'Yes, I will create a brand-new WordPress website for you if you have not created yet. ',
            'gig_id' => $gig1->id,
        ]);
      

        $gig1Req = GigRequirement::create([
            'requirement' => 'Send me complete Requirements',
            'gig_id' => $gig1->id,
        ]);

        $seller->increment('gigs_count');

              // gig 3
              $seller = Seller::inRandomOrder()->first();
              $gig1 = Gig::create([
                'is_approved' => true,
                'package_type' => 1,
                'seller_id' => $seller->id, 
            ]);
    
            $gig1Detail = GigDetail::create([
                'title' => 'I will fix wordpress issues wordpress errors',
                'description' => "<div><em>Dear Respected Client,&nbsp;</em></div><div><br></div><div><strong>***Please Send me a Message before placing the order and complete instructions of work to be done so that to avoid any misunderstandings,.***&nbsp;</strong></div><div><br></div><div><br></div><div>Do you have any issues with your WordPress &amp; WooCommerce website which is affecting your business? Do not worry you have clicked on the right gig!!</div><div><br></div><div>I am full stack developer with more than 6 years experience in Web developing and programming.</div><div><br></div><div>I have worked in more than 100 sites which gave me experience and the knowledge about problems, issues and how to fix them so fast.</div><div><br></div><div><strong>My Services:&nbsp;</strong></div><div><br></div><ul><li>Fix your website HTML and CSS issue</li><li>Fix responsive Problem &amp; errors on your Website</li><li>Fix your WordPress Plugins and Theme error</li><li>Fix any WooCommerce &amp; E-commerce issue on your Wordpress Website</li><li>Customisation and developing your theme and plugins in Wordpress</li><li>Fix any Bug, Issue and Error in Your WordPress Website</li></ul><div><br></div><div><strong>Why Hire Me ?</strong></div><div><br></div><ul><li>Fast Delivery</li><li>Unlimited Revisions</li><li>100% Work to be done according to your requirements</li><li>100% Satisfaction</li></ul><div><br></div><div><br></div><div><strong>Custom Services are always available, send me message for the details. Feel free to message me anytime&nbsp;</strong></div>",
                'slug' => 'i-will-fix-wordpress-issues-wordpress-errors',
                'gig_id' => $gig1->id,
            ]);
    
            $gig1Image = GigImage::create([
                'image_path' => '1669017050_Screenshot 2022-11-21 at 12-50-10 753abcd0a67987086e0e8c3542fc60ef34549924.webp (WEBP Image 680 × 411 pixels).png',
                'image_type' => ImageType::Main->value,
                'gig_id' => $gig1->id,
            ]);
        
    
            $gig1Image2 = GigImage::create([
                'image_path' => '1669017050_Screenshot 2022-11-21 at 12-49-24 d87822427f078b1d86c3738cd0e8e800044d0b99.webp (WEBP Image 680 × 420 pixels).png',
                'image_type' => ImageType::Additional->value,
                'gig_id' => $gig1->id,
            ]);
        
    
            $gig1Image3 = GigImage::create([
                'image_path' => '1669017050_Screenshot 2022-11-21 at 12-49-24 d87822427f078b1d86c3738cd0e8e800044d0b99.webp (WEBP Image 680 × 420 pixels).png',
                'image_type' => ImageType::Additional->value,
                'gig_id' => $gig1->id,
            ]);
           
            $gig1->tags()->attach(Tag::find(1));
            $gig1->tags()->attach(Tag::find(3));
            $gig1->tags()->attach(Tag::find(5));
    
            $gig1->gigStat()->save(new GigStat);
    
            $gig1Package = GigPackage::create([
                'type' => PackageType::Basic->value,
                'package_name' => 'Basic Wordpress Fix/Customize',
                'package_description' => 'I will fix 1 small issue and Customize 1 small thing ',
                'price' => 5,
                'delivery_days' => 1,
                'gig_id' => $gig1->id,
            ]);
    
    
            $gig1Package = GigPackage::create([
                'type' => PackageType::Standard->value,
                'package_name' => 'Standard Wordpress Fix/Customize ',
                'package_description' => 'I will fix 2-3 small issues and Customize 2-3 small things',
                'price' => 10,
                'delivery_days' => 3,
                'gig_id' => $gig1->id,
            ]);
    
            $gig1Package = GigPackage::create([
                'type' => PackageType::Advance->value,
                'package_name' => 'Pro WordPress Theme Customisation',
                'package_description' => 'I will do few customisation in your WordPress Website',
                'price' => 15,
                'delivery_days' => 5,
                'gig_id' => $gig1->id,
            ]);
    
         
    
            $gig1Faq = GigFaq::create([
                'question' => 'What do you need to clone, redesign wordpress or revamp wordpress wesbite?',
                'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
                'gig_id' => $gig1->id,
            ]);
          
    
            $gig1Faq = GigFaq::create([
                'question' => 'Can you customize, redesign or revamp wordpress website which is already existing?',
                'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
                'gig_id' => $gig1->id,
            ]);
          
    
            $gig1Faq = GigFaq::create([
                'question' => 'Do you create new wordpress website or elementor pro website ?',
                'answer' => 'Yes, I will create a brand-new WordPress website for you if you have not created yet. ',
                'gig_id' => $gig1->id,
            ]);
          
    
            $gig1Req = GigRequirement::create([
                'requirement' => 'Send me complete Requirements',
                'gig_id' => $gig1->id,
            ]);
    
            $seller->increment('gigs_count');

            // gig 4
            $seller = Seller::inRandomOrder()->first();
            $gig1 = Gig::create([
                'is_approved' => true,
                'package_type' => 0,
                'seller_id' => $seller->id, 
            ]);
    
            $gig1Detail = GigDetail::create([
                'title' => 'I will create a clean and modern wordpress website',
                'description' => "<div>About This Service</div><div><br><strong>Note : Must Contact Me Before Placing an Order to avoid cancellation</strong><br><strong>Gig Service: clone, redesign wordpress, revamp wordpress website with elementor pro</strong><br><br>Do you feel like your website UI design looks unprofessional, outdated, or unresponsive?<br>If so, then you don't need to scroll anymore. I'm the best choice for you.<br><br>I have 3 years of immense experience in WordPress development, I'm a pro expert in <strong>Elementor Pro, WP Bakery, and Divi Page Builder.</strong><br><br>I will clone, redesign wordpress website, and revamp wordpress web-site with elementor pro, divi page builder and other popular premium plugins.<br><br>I'd love to create all kinds of professional WordPress landing pages using amazing page builders (<strong><em>Elementor Pro</em></strong> \ <strong><em>Divi</em></strong> \ <strong><em>Bakery</em></strong> \ <strong><em>Oxygen </em></strong><strong>\ Brave)</strong><br><br><strong>Services i offer here:</strong><br>Clone / Duplicate / redesign website<br>Rebuild / revamp wordpress we_bsite<br>Convert Figma, PSD, XD to elementor pro<br>Pixel perfect all devices responsive<br>Minimal design<br>Fast speed loading<br>Create full new site from scratch<br>Update PHP version, plugins and theme<br><br><strong>Bonus:</strong><br>1 Months of free support<br>Free Basic Speed Optimization<br><br><strong>Why choose me?</strong><br>24/7 free support<br>Free revisions</div>",
                'slug' => 'i-will-create-a-clean-and-modern-wordpress-website',
                'gig_id' => $gig1->id,
            ]);
      
    
            // $category1 = Category::create([
            //     'name' => 'Web Development',
            //     'description' => 'WordPress Website Development'
            // ]);
    
            // $category1Details = CategoryDetail::create([
            //     'tagline' => 'Find a developer to improve your WordPress site or build one from scratch',
            //     'icon' => 'lTSebsweDnECHPRcRdeQOk2YmwfQmU-metaMTAxOS5zdmc=-.svg',
            //     'cover_photo' =>'LeVWjauUVU2NyYinZ6cc4MITwTcbp7-metaaGVhZGVyX2ltZy5wbmc=-.png',
            //     'category_id' => $category1->id
            // ]);
    
         
            // $gig1->categories()->attach([['category_id' => $category1->id,'level' => 0]]);
    
            $gig1Image = GigImage::create([
                'image_path' => '1669015276_Screenshot 2022-11-21 at 11-04-39 5052e62a1357c71ca3f4a66f832ef29a8f3e55dd.webp (WEBP Image 680 × 453 pixels).png',
                'image_type' => ImageType::Main->value,
                'gig_id' => $gig1->id,
            ]);
        
    
            $gig1Image2 = GigImage::create([
                'image_path' => '1669015276_Screenshot 2022-11-21 at 11-04-21 661dd8dc716a278ec2a2f32579478140c130e9ce.webp (WEBP Image 680 × 453 pixels).png',
                'image_type' => ImageType::Additional->value,
                'gig_id' => $gig1->id,
            ]);
        
    
            $gig1Image3 = GigImage::create([
                'image_path' => '1669015276_Screenshot 2022-11-21 at 11-02-22 137bdea3e8fe22b113b19a1c0d26a78124570657.webp (WEBP Image 680 × 453 pixels).png',
                'image_type' => ImageType::Additional->value,
                'gig_id' => $gig1->id,
            ]);
           
    
            $gig1->tags()->attach(Tag::find(1));
            $gig1->tags()->attach(Tag::find(3));
            $gig1->tags()->attach(Tag::find(5));
    
            $gig1->gigStat()->save(new GigStat);
    
            $gig1Package = GigPackage::create([
                'type' => PackageType::Basic->value,
                'package_name' => 'Small - redesign wordpress website',
                'package_description' => 'clone website, revamp wordpress website, redesign wordpress website with elementor pro, 4-5 sections',
                'price' => 5,
                'delivery_days' => 1,
                'gig_id' => $gig1->id,
            ]);
    
    
            $gig1PackageService1 = GigService::create([
                'name' => 'Clone'
            ]);
            $gig1Package->services()->attach($gig1PackageService1);
    
            $gig1PackageService2 = GigService::create([
                'name' => 'Design Pro'
            ]);
            $gig1Package->services()->attach($gig1PackageService2);
    
            $gig1PackageService3 = GigService::create([
                'name' => 'Responsive Design'
            ]);
            $gig1Package->services()->attach($gig1PackageService3);
    
            $gig1Faq = GigFaq::create([
                'question' => 'What do you need to clone, redesign wordpress or revamp wordpress wesbite?',
                'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
                'gig_id' => $gig1->id,
            ]);
          
    
            $gig1Faq = GigFaq::create([
                'question' => 'Can you customize, redesign or revamp wordpress website which is already existing?',
                'answer' => 'To get started cloning, redesigning, revamp wordpress website. you have to provide me login access to your website, also provide the link for login.',
                'gig_id' => $gig1->id,
            ]);
          
    
            $gig1Faq = GigFaq::create([
                'question' => 'Do you create new wordpress website or elementor pro website ?',
                'answer' => 'Yes, I will create a brand-new WordPress website for you if you have not created yet. ',
                'gig_id' => $gig1->id,
            ]);
          
    
            $gig1Req = GigRequirement::create([
                'requirement' => 'Send me complete Requirements',
                'gig_id' => $gig1->id,
            ]);
    
            $seller->increment('gigs_count');

            // attach categories
            $categories = Category::all();
            $count = $categories->count();
            $gigs = Gig::all();
            foreach($gigs as $gig)
            {
                if($count > 0)
                {
                    if(is_null($categories[$count-1]->parent_id)){
                        $gig->categories()->attach([['category_id' => $categories[$count-1]->id,'level' => 0]]);
                    } else{
                        $gig->categories()->attach([['category_id' => $categories[$count-1]->id,'level' => 1]]);
                        $gig->categories()->attach([['category_id' => $categories[$count-1]->parent_id,'level' => 0]]);
                    }
                   $count -=1;
                }
            }

    }
}
