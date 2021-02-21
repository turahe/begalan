<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run()
    {
        foreach ($this->defaultCategories as $category) {
            $category = Category::updateOrCreate($category);
            if (app()->environment('staging')) {
                $category->addMedia(storage_path('app/seeds/images/'.mt_rand(1, 20).'.jpg'))
                    ->preservingOriginal()
                    ->withResponsiveImages()
                    ->toMediaCollection();
            }
        }
    }

    /**
     * @var array[]
     */
    protected $defaultCategories = [
        [
            'name' => 'Development',
            'parent_id' => null,
        ],
        [
            'name' => 'Business',
            'parent_id' => null,
        ],
        [
            'name' => 'Finance & Accounting',
            'parent_id' => null,
        ],
        [
            'name' => 'IT & Software',
            'parent_id' => null,
        ],
        [
            'name' => 'Office Productivity',
            'parent_id' => null,
        ],
        [
            'name' => 'Personal Development',
            'parent_id' => null,
        ],
        [
            'name' => 'Design',
            'parent_id' => null,
        ],
        [
            'name' => 'Marketing',
            'parent_id' => null,
        ],
        [
            'name' => 'LifeStyle',
            'parent_id' => null,
        ],
        [
            'name' => 'Photography',
            'parent_id' => null,
        ],
        [
            'name' => 'Health & Fitness',
            'parent_id' => null,
        ],
        [
            'name' => 'Music',
            'parent_id' => null,
        ],
        [
            'name' => 'Teaching & Academics',
            'parent_id' => null,
        ],
        [
            'name' => 'Web Development',
            'parent_id' => 1,
        ],
        [
            'name' => 'Data Science',
            'parent_id' => 1,
        ],
        [
            'name' => 'Mobile Apps',
            'parent_id' => 1,
        ], [
            'name' => 'Programming Languages',
            'parent_id' => 1,
        ],
        [
            'name' => 'Game Development',
            'parent_id' => 1,
        ],
        [
            'name' => 'Databases',
            'parent_id' => 1,
        ],
        [
            'name' => 'Software Testing',
            'parent_id' => 1,
        ],
        [
            'name' => 'Software Engineering',
            'parent_id' => 1,
        ],
        [
            'name' => 'Development Tools',
            'parent_id' => 1,
        ],
        [
            'name' => 'E-Commerce',
            'parent_id' => 1,
        ],
        [
            'name' => 'Finance',
            'parent_id' => 2,
        ],
        [
            'name' => 'Entrepreneurship',
            'parent_id' => 2,
        ],
        [
            'name' => 'Management',
            'parent_id' => 2,
        ],
        [
            'name' => 'Sales',
            'parent_id' => 2,
        ],
        [
            'name' => 'Strategy',
            'parent_id' => 2,
        ],
        [
            'name' => 'Operations',
            'parent_id' => 2,
        ],
        [
            'name' => 'Project Management',
            'parent_id' => 2,
        ],
        [
            'name' => 'Business Law',
            'parent_id' => 2,
        ],
        [
            'name' => 'Data & Analytics',
            'parent_id' => 2,
        ],
        [
            'name' => 'Home Business',
            'parent_id' => 2,
        ],
        [
            'name' => 'Human Resources',
            'parent_id' => 2,
        ],
        [
            'name' => 'Industry',
            'parent_id' => 2,
        ],
        [
            'name' => 'Home Business',
            'parent_id' => 2,
        ],
        [
            'name' => 'Media',
            'parent_id' => 2,
        ],
        [
            'name' => 'Real Estate',
            'parent_id' => 2,
        ],
        [
            'name' => 'Other',
            'parent_id' => 2,
        ],
        [
            'name' => 'Accounting & Bookkeeping',
            'parent_id' => 3,
        ],
        [
            'name' => 'Compliance',
            'parent_id' => 3,
        ],
        [
            'name' => 'Cryptocurrency & Blockchain',
            'parent_id' => 3,
        ],
        [
            'name' => 'Economics',
            'parent_id' => 3,
        ],
        [
            'name' => 'Finance',
            'parent_id' => 3,
        ],
        [
            'name' => 'Finance Cert & Exam Prep',
            'parent_id' => 3,
        ],
        [
            'name' => 'Financial Modeling & Analysis',
            'parent_id' => 3,
        ],
        [
            'name' => 'Investing & Trading',
            'parent_id' => 3,
        ],
        [
            'name' => 'Money Management Tool',
            'parent_id' => 3,
        ],
        [
            'name' => 'Taxes',
            'parent_id' => 3,
        ],
        [
            'name' => 'Other Finance Economics',
            'parent_id' => 3,
        ],
        [
            'name' => 'IT Certification',
            'parent_id' => 4,
        ],
        [
            'name' => 'Network & Security',
            'parent_id' => 4,
        ],
        [
            'name' => 'Hardware',
            'parent_id' => 4,
        ],
        [
            'name' => 'Operation Systems',
            'parent_id' => 4,
        ],
        [
            'name' => 'Other',
            'parent_id' => 4,
        ],
        [
            'name' => 'Microsoft',
            'parent_id' => 5,
        ],
        [
            'name' => 'Apple',
            'parent_id' => 5,
        ],
        [
            'name' => 'Google',
            'parent_id' => 5,
        ],
        [
            'name' => 'SAP',
            'parent_id' => 5,
        ],
        [
            'name' => 'Oracle',
            'parent_id' => 5,
        ],
        [
            'name' => 'Other',
            'parent_id' => 5,
        ],
        [
            'name' => 'Personal Transformation',
            'parent_id' => 6,
        ],
        [
            'name' => 'Productivity',
            'parent_id' => 6,
        ],
        [
            'name' => 'Leadership',
            'parent_id' => 6,
        ],
        [
            'name' => 'Personal Finance',
            'parent_id' => 6,
        ],
        [
            'name' => 'Career Development',
            'parent_id' => 6,
        ],
        [
            'name' => 'Parenting & Relationships',
            'parent_id' => 6,
        ],
        [
            'name' => 'Happiness',
            'parent_id' => 6,
        ],
        [
            'name' => 'Religion & Spirituality',
            'parent_id' => 6,
        ],
        [
            'name' => 'Personal Br& Building',
            'parent_id' => 6,
        ],
        [
            'name' => 'Creativity',
            'parent_id' => 6,
        ],
        [
            'name' => 'Influence',
            'parent_id' => 6,
        ],
        [
            'name' => 'Self Esteem',
            'parent_id' => 6,
        ],
        [
            'name' => 'Stress Management',
            'parent_id' => 6,
        ],
        [
            'name' => 'Memory & Study Skills',
            'parent_id' => 6,
        ],
        [
            'name' => 'Motivation',
            'parent_id' => 6,
        ],
        [
            'name' => 'Other',
            'parent_id' => 6,
        ],
        [
            'name' => 'Web Design',
            'parent_id' => 7,
        ],
        [
            'name' => 'Graphic Design',
            'parent_id' => 7,
        ],
        [
            'name' => 'Design Tools',
            'parent_id' => 7,
        ],
        [
            'name' => 'User Experience',
            'parent_id' => 7,
        ],
        [
            'name' => 'Game Design',
            'parent_id' => 7,
        ],
        [
            'name' => 'Design Thinking',
            'parent_id' => 7,
        ],
        [
            'name' => 'Other',
            'parent_id' => 7,
        ],
        [
            'name' => '3D & Animation',
            'parent_id' => 7,
        ],
        [
            'name' => 'Fashion',
            'parent_id' => 7,
        ],
        [
            'name' => 'Architecture Design',
            'parent_id' => 7,
        ],
        [
            'name' => 'Interior Design',
            'parent_id' => 7,
        ],
        [
            'name' => 'Other',
            'parent_id' => 7,
        ],
        [
            'name' => 'Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Digital Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Search Engine Optimization',
            'parent_id' => 8,
        ],
        [
            'name' => 'Social Media Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Br&ing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Marketing Fundamental',
            'parent_id' => 8,
        ],
        [
            'name' => 'Analytics & Automation',
            'parent_id' => 8,
        ],
        [
            'name' => 'Public Relation',
            'parent_id' => 8,
        ],
        [
            'name' => 'Advertising',
            'parent_id' => 8,
        ],

        [
            'name' => 'Video & Mobile Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Content Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Growth Hacking',
            'parent_id' => 8,
        ],
        [
            'name' => 'Affiliate Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Product Marketing',
            'parent_id' => 8,
        ],
        [
            'name' => 'Other',
            'parent_id' => 8,
        ],
        [
            'name' => 'Arts & Crafts',
            'parent_id' => 9,
        ],
        [
            'name' => 'Food & Beverage',
            'parent_id' => 9,
        ],
        [
            'name' => 'Beauty & Make up',
            'parent_id' => 9,
        ],
        [
            'name' => 'Travel',
            'parent_id' => 9,
        ],
        [
            'name' => 'Gaming',
            'parent_id' => 9,
        ],
        [
            'name' => 'Home Improvement',
            'parent_id' => 9,
        ],
        [
            'name' => 'Pet Care & Training',
            'parent_id' => 9,
        ],
        [
            'name' => 'Other',
            'parent_id' => 9,
        ],
        [
            'name' => 'Digital Photography',
            'parent_id' => 10,
        ],
        [
            'name' => 'Photography Fundamental',
            'parent_id' => 10,
        ],
        [
            'name' => 'Portrait',
            'parent_id' => 10,
        ],
        [
            'name' => 'Photography Tools',
            'parent_id' => 10,
        ],
        [
            'name' => 'Commercial Photography',
            'parent_id' => 10,
        ],
        [
            'name' => 'Video Design',
            'parent_id' => 10,
        ],
        [
            'name' => 'Other',
            'parent_id' => 10,
        ],
        [
            'name' => 'Fitness',
            'parent_id' => 11,
        ],
        [
            'name' => 'General Health',
            'parent_id' => 11,
        ],
        [
            'name' => 'Sports',
            'parent_id' => 11,
        ],
        [
            'name' => 'Nutrition',
            'parent_id' => 11,
        ],
        [
            'name' => 'Yoga',
            'parent_id' => 11,
        ],
        [
            'name' => 'Mental Health',
            'parent_id' => 11,
        ],
        [
            'name' => 'Dieting',
            'parent_id' => 11,
        ],
        [
            'name' => 'Self Defense',
            'parent_id' => 11,
        ],
        [
            'name' => 'Safety & First Aid',
            'parent_id' => 11,
        ],
        [
            'name' => 'Dance',
            'parent_id' => 11,
        ],
        [
            'name' => 'Mediation',
            'parent_id' => 11,
        ],
        [
            'name' => 'Other',
            'parent_id' => 11,
        ],
        [
            'name' => 'Instruments',
            'parent_id' => 12,
        ],
        [
            'name' => 'Production',
            'parent_id' => 12,
        ],
        [
            'name' => 'Music Fundamental',
            'parent_id' => 12,
        ],
        [
            'name' => 'Vocal',
            'parent_id' => 12,
        ],
        [
            'name' => 'Music Techniques',
            'parent_id' => 12,
        ],
        [
            'name' => 'Music Software',
            'parent_id' => 12,
        ],
        [
            'name' => 'Other',
            'parent_id' => 12,
        ],
        [
            'name' => 'Engineering',
            'parent_id' => 13,
        ],
        [
            'name' => 'Humanities',
            'parent_id' => 13,
        ],
        [
            'name' => 'Math',
            'parent_id' => 13,
        ],
        [
            'name' => 'Science',
            'parent_id' => 13,
        ],
        [
            'name' => 'Online Education',
            'parent_id' => 13,
        ],
        [
            'name' => 'Social Science',
            'parent_id' => 13,
        ],
        [
            'name' => 'Language',
            'parent_id' => 13,
        ],
        [
            'name' => 'Teacher Training',
            'parent_id' => 13,
        ],
        [
            'name' => 'Test Prep',
            'parent_id' => 13,
        ],
        [
            'name' => 'Other Teaching & Academics',
            'parent_id' => 13,
        ],
        [
            'name' => 'Javascript',
            'parent_id' => 14,
        ],
        [
            'name' => 'React',
            'parent_id' => 14,
        ],
        [
            'name' => 'Angular',
            'parent_id' => 14,
        ],
        [
            'name' => 'CSS',
            'parent_id' => 14,
        ],
        [
            'name' => 'PHP',
            'parent_id' => 14,
        ],
        [
            'name' => 'NodeJs',
            'parent_id' => 14,
        ],
        [
            'name' => 'Python',
            'parent_id' => 14,
        ],
        [
            'name' => 'Wordpress',
            'parent_id' => 14,
        ],
        [
            'name' => 'Laravel',
            'parent_id' => 14,
        ],
        [
            'name' => 'O2system',
            'parent_id' => 14,
        ],
        [
            'name' => 'Codeigniter',
            'parent_id' => 14,
        ],
        [
            'name' => 'YII2',
            'parent_id' => 14,
        ],
        [
            'name' => 'Python',
            'parent_id' => 15,
        ],
        [
            'name' => 'Machine Learning',
            'parent_id' => 15,
        ],
        [
            'name' => 'Deep Learning',
            'parent_id' => 15,
        ],
        [
            'name' => 'Data Analysis',
            'parent_id' => 15,
        ],
        [
            'name' => 'Artificial Intelligence',
            'parent_id' => 15,
        ],
        [
            'name' => 'R',
            'parent_id' => 15,
        ],
        [
            'name' => 'Tensor Flow',
            'parent_id' => 15,
        ],
        [
            'name' => 'Neural Network',
            'parent_id' => 15,
        ],
        [
            'name' => 'Google Flutter',
            'parent_id' => 16,
        ],
        [
            'name' => 'Android Development',
            'parent_id' => 16,
        ],
        [
            'name' => 'IOS Development',
            'parent_id' => 16,
        ],
        [
            'name' => 'Swift',
            'parent_id' => 16,
        ],
        [
            'name' => 'React Native',
            'parent_id' => 16,
        ],
        [
            'name' => 'Dart Programing Language',
            'parent_id' => 16,
        ],
        [
            'name' => 'Mobile Development',
            'parent_id' => 16,
        ],
        [
            'name' => 'Kotlin',
            'parent_id' => 16,
        ],
        [
            'name' => 'Redux Framework',
            'parent_id' => 16,
        ],
        [
            'name' => 'Python',
            'parent_id' => 17,
        ],
        [
            'name' => 'Java',
            'parent_id' => 17,
        ],
        [
            'name' => 'C#',
            'parent_id' => 17,
        ],
        [
            'name' => 'C/C++',
            'parent_id' => 17,
        ],
        [
            'name' => 'React',
            'parent_id' => 17,
        ],
        [
            'name' => 'Javascript',
            'parent_id' => 17,
        ],
        [
            'name' => 'PHP',
            'parent_id' => 17,
        ],
        [
            'name' => 'Unity',
            'parent_id' => 18,
        ],
        [
            'name' => 'Game Development Fundamental',
            'parent_id' => 18,
        ],
        [
            'name' => 'Unreal Engine',
            'parent_id' => 18,
        ],
        [
            'name' => '3D Game Development',
            'parent_id' => 18,
        ],
        [
            'name' => 'C++',
            'parent_id' => 18,
        ],
        [
            'name' => '2D Game Development',
            'parent_id' => 18,
        ],
        [
            'name' => 'Unreal Engine Blueprint',
            'parent_id' => 18,
        ],
        [
            'name' => 'Blender',
            'parent_id' => 18,
        ],
        [
            'name' => 'SQL',
            'parent_id' => 19,
        ],
        [
            'name' => 'MySQL',
            'parent_id' => 19,
        ],
        [
            'name' => 'Oracle SQL',
            'parent_id' => 19,
        ],
        [
            'name' => 'Oracle Certification',
            'parent_id' => 19,
        ],
        [
            'name' => 'Mongo DB',
            'parent_id' => 19,
        ],
        [
            'name' => 'Apache Kafka',
            'parent_id' => 19,
        ],
        [
            'name' => 'SQL Server',
            'parent_id' => 19,
        ],
        [
            'name' => 'Database Management',
            'parent_id' => 19,
        ],
        [
            'name' => 'PostgreSQL',
            'parent_id' => 19,
        ],
        [
            'name' => 'Selenium WebDriver',
            'parent_id' => 20,
        ],
        [
            'name' => 'Java',
            'parent_id' => 20,
        ],
        [
            'name' => 'Selenium Testing Framework',
            'parent_id' => 20,
        ],
        [
            'name' => 'Automation Testing',
            'parent_id' => 20,
        ],
        [
            'name' => 'API Testing',
            'parent_id' => 20,
        ],
        [
            'name' => 'Rest Assured',
            'parent_id' => 20,
        ],
        [
            'name' => 'Appium',
            'parent_id' => 20,
        ],
        [
            'name' => 'Quality Assurance',
            'parent_id' => 20,
        ],
        [
            'name' => 'AWS Certification Developer - Associate',
            'parent_id' => 21,
        ],
        [
            'name' => 'AWS Certification',
            'parent_id' => 22,
        ],
        [
            'name' => 'Coding Interview',
            'parent_id' => 21,
        ],
        [
            'name' => 'Kubernetes',
            'parent_id' => 21,
        ],
        [
            'name' => 'Certification Kubernetes Application Developer (CKAD)',
            'parent_id' => 21,
        ],
        [
            'name' => 'MicroService',
            'parent_id' => 21,
        ],
        [
            'name' => 'Python',
            'parent_id' => 21,
        ],
        [
            'name' => 'Agile',
            'parent_id' => 21,
        ],
        [
            'name' => 'Professional Scrum Master',
            'parent_id' => 21,
        ],
        [
            'name' => 'Docker',
            'parent_id' => 22,
        ],
        [
            'name' => 'Kubernetes',
            'parent_id' => 22,
        ],
        [
            'name' => 'Git',
            'parent_id' => 22,
        ],
        [
            'name' => 'DevOps',
            'parent_id' => 22,
        ],
        [
            'name' => 'Jenkins',
            'parent_id' => 22,
        ],
        [
            'name' => 'AWS Certification',
            'parent_id' => 22,
        ],
        [
            'name' => 'AWS Certification Developer - Associate',
            'parent_id' => 22,
        ],
        [
            'name' => 'Jira',
            'parent_id' => 22,
        ],
        [
            'name' => 'NodeJs',
            'parent_id' => 22,
        ],
        [
            'name' => '.NET',
            'parent_id' => 23,
        ],
        [
            'name' => 'Shopify',
            'parent_id' => 23,
        ],
        [
            'name' => 'WooCommerce',
            'parent_id' => 23,
        ],
        [
            'name' => 'Wordpress',
            'parent_id' => 23,
        ],
        [
            'name' => 'Wordpress for Ecommerce',
            'parent_id' => 23,
        ],
        [
            'name' => 'Magento',
            'parent_id' => 23,
        ],
        [
            'name' => 'Membership Website',
            'parent_id' => 23,
        ],
        [
            'name' => 'Dropshipping',
            'parent_id' => 23,
        ],
    ];
}
