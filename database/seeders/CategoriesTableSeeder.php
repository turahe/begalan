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
            'title' => 'Development',
            'parent_id' => null,
        ],
        [
            'title' => 'Business',
            'parent_id' => null,
        ],
        [
            'title' => 'Finance & Accounting',
            'parent_id' => null,
        ],
        [
            'title' => 'IT & Software',
            'parent_id' => null,
        ],
        [
            'title' => 'Office Productivity',
            'parent_id' => null,
        ],
        [
            'title' => 'Personal Development',
            'parent_id' => null,
        ],
        [
            'title' => 'Design',
            'parent_id' => null,
        ],
        [
            'title' => 'Marketing',
            'parent_id' => null,
        ],
        [
            'title' => 'LifeStyle',
            'parent_id' => null,
        ],
        [
            'title' => 'Photography',
            'parent_id' => null,
        ],
        [
            'title' => 'Health & Fitness',
            'parent_id' => null,
        ],
        [
            'title' => 'Music',
            'parent_id' => null,
        ],
        [
            'title' => 'Teaching & Academics',
            'parent_id' => null,
        ],
        [
            'title' => 'Web Development',
            'parent_id' => 1,
        ],
        [
            'title' => 'Data Science',
            'parent_id' => 1,
        ],
        [
            'title' => 'Mobile Apps',
            'parent_id' => 1,
        ], [
            'title' => 'Programming Languages',
            'parent_id' => 1,
        ],
        [
            'title' => 'Game Development',
            'parent_id' => 1,
        ],
        [
            'title' => 'Databases',
            'parent_id' => 1,
        ],
        [
            'title' => 'Software Testing',
            'parent_id' => 1,
        ],
        [
            'title' => 'Software Engineering',
            'parent_id' => 1,
        ],
        [
            'title' => 'Development Tools',
            'parent_id' => 1,
        ],
        [
            'title' => 'E-Commerce',
            'parent_id' => 1,
        ],
        [
            'title' => 'Finance',
            'parent_id' => 2,
        ],
        [
            'title' => 'Entrepreneurship',
            'parent_id' => 2,
        ],
        [
            'title' => 'Management',
            'parent_id' => 2,
        ],
        [
            'title' => 'Sales',
            'parent_id' => 2,
        ],
        [
            'title' => 'Strategy',
            'parent_id' => 2,
        ],
        [
            'title' => 'Operations',
            'parent_id' => 2,
        ],
        [
            'title' => 'Project Management',
            'parent_id' => 2,
        ],
        [
            'title' => 'Business Law',
            'parent_id' => 2,
        ],
        [
            'title' => 'Data & Analytics',
            'parent_id' => 2,
        ],
        [
            'title' => 'Home Business',
            'parent_id' => 2,
        ],
        [
            'title' => 'Human Resources',
            'parent_id' => 2,
        ],
        [
            'title' => 'Industry',
            'parent_id' => 2,
        ],
        [
            'title' => 'Home Business',
            'parent_id' => 2,
        ],
        [
            'title' => 'Media',
            'parent_id' => 2,
        ],
        [
            'title' => 'Real Estate',
            'parent_id' => 2,
        ],
        [
            'title' => 'Other',
            'parent_id' => 2,
        ],
        [
            'title' => 'Accounting & Bookkeeping',
            'parent_id' => 3,
        ],
        [
            'title' => 'Compliance',
            'parent_id' => 3,
        ],
        [
            'title' => 'Cryptocurrency & Blockchain',
            'parent_id' => 3,
        ],
        [
            'title' => 'Economics',
            'parent_id' => 3,
        ],
        [
            'title' => 'Finance',
            'parent_id' => 3,
        ],
        [
            'title' => 'Finance Cert & Exam Prep',
            'parent_id' => 3,
        ],
        [
            'title' => 'Financial Modeling & Analysis',
            'parent_id' => 3,
        ],
        [
            'title' => 'Investing & Trading',
            'parent_id' => 3,
        ],
        [
            'title' => 'Money Management Tool',
            'parent_id' => 3,
        ],
        [
            'title' => 'Taxes',
            'parent_id' => 3,
        ],
        [
            'title' => 'Other Finance Economics',
            'parent_id' => 3,
        ],
        [
            'title' => 'IT Certification',
            'parent_id' => 4,
        ],
        [
            'title' => 'Network & Security',
            'parent_id' => 4,
        ],
        [
            'title' => 'Hardware',
            'parent_id' => 4,
        ],
        [
            'title' => 'Operation Systems',
            'parent_id' => 4,
        ],
        [
            'title' => 'Other',
            'parent_id' => 4,
        ],
        [
            'title' => 'Microsoft',
            'parent_id' => 5,
        ],
        [
            'title' => 'Apple',
            'parent_id' => 5,
        ],
        [
            'title' => 'Google',
            'parent_id' => 5,
        ],
        [
            'title' => 'SAP',
            'parent_id' => 5,
        ],
        [
            'title' => 'Oracle',
            'parent_id' => 5,
        ],
        [
            'title' => 'Other',
            'parent_id' => 5,
        ],
        [
            'title' => 'Personal Transformation',
            'parent_id' => 6,
        ],
        [
            'title' => 'Productivity',
            'parent_id' => 6,
        ],
        [
            'title' => 'Leadership',
            'parent_id' => 6,
        ],
        [
            'title' => 'Personal Finance',
            'parent_id' => 6,
        ],
        [
            'title' => 'Career Development',
            'parent_id' => 6,
        ],
        [
            'title' => 'Parenting & Relationships',
            'parent_id' => 6,
        ],
        [
            'title' => 'Happiness',
            'parent_id' => 6,
        ],
        [
            'title' => 'Religion & Spirituality',
            'parent_id' => 6,
        ],
        [
            'title' => 'Personal Br& Building',
            'parent_id' => 6,
        ],
        [
            'title' => 'Creativity',
            'parent_id' => 6,
        ],
        [
            'title' => 'Influence',
            'parent_id' => 6,
        ],
        [
            'title' => 'Self Esteem',
            'parent_id' => 6,
        ],
        [
            'title' => 'Stress Management',
            'parent_id' => 6,
        ],
        [
            'title' => 'Memory & Study Skills',
            'parent_id' => 6,
        ],
        [
            'title' => 'Motivation',
            'parent_id' => 6,
        ],
        [
            'title' => 'Other',
            'parent_id' => 6,
        ],
        [
            'title' => 'Web Design',
            'parent_id' => 7,
        ],
        [
            'title' => 'Graphic Design',
            'parent_id' => 7,
        ],
        [
            'title' => 'Design Tools',
            'parent_id' => 7,
        ],
        [
            'title' => 'User Experience',
            'parent_id' => 7,
        ],
        [
            'title' => 'Game Design',
            'parent_id' => 7,
        ],
        [
            'title' => 'Design Thinking',
            'parent_id' => 7,
        ],
        [
            'title' => 'Other',
            'parent_id' => 7,
        ],
        [
            'title' => '3D & Animation',
            'parent_id' => 7,
        ],
        [
            'title' => 'Fashion',
            'parent_id' => 7,
        ],
        [
            'title' => 'Architecture Design',
            'parent_id' => 7,
        ],
        [
            'title' => 'Interior Design',
            'parent_id' => 7,
        ],
        [
            'title' => 'Other',
            'parent_id' => 7,
        ],
        [
            'title' => 'Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Digital Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Search Engine Optimization',
            'parent_id' => 8,
        ],
        [
            'title' => 'Social Media Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Br&ing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Marketing Fundamental',
            'parent_id' => 8,
        ],
        [
            'title' => 'Analytics & Automation',
            'parent_id' => 8,
        ],
        [
            'title' => 'Public Relation',
            'parent_id' => 8,
        ],
        [
            'title' => 'Advertising',
            'parent_id' => 8,
        ],

        [
            'title' => 'Video & Mobile Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Content Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Growth Hacking',
            'parent_id' => 8,
        ],
        [
            'title' => 'Affiliate Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Product Marketing',
            'parent_id' => 8,
        ],
        [
            'title' => 'Other',
            'parent_id' => 8,
        ],
        [
            'title' => 'Arts & Crafts',
            'parent_id' => 9,
        ],
        [
            'title' => 'Food & Beverage',
            'parent_id' => 9,
        ],
        [
            'title' => 'Beauty & Make up',
            'parent_id' => 9,
        ],
        [
            'title' => 'Travel',
            'parent_id' => 9,
        ],
        [
            'title' => 'Gaming',
            'parent_id' => 9,
        ],
        [
            'title' => 'Home Improvement',
            'parent_id' => 9,
        ],
        [
            'title' => 'Pet Care & Training',
            'parent_id' => 9,
        ],
        [
            'title' => 'Other',
            'parent_id' => 9,
        ],
        [
            'title' => 'Digital Photography',
            'parent_id' => 10,
        ],
        [
            'title' => 'Photography Fundamental',
            'parent_id' => 10,
        ],
        [
            'title' => 'Portrait',
            'parent_id' => 10,
        ],
        [
            'title' => 'Photography Tools',
            'parent_id' => 10,
        ],
        [
            'title' => 'Commercial Photography',
            'parent_id' => 10,
        ],
        [
            'title' => 'Video Design',
            'parent_id' => 10,
        ],
        [
            'title' => 'Other',
            'parent_id' => 10,
        ],
        [
            'title' => 'Fitness',
            'parent_id' => 11,
        ],
        [
            'title' => 'General Health',
            'parent_id' => 11,
        ],
        [
            'title' => 'Sports',
            'parent_id' => 11,
        ],
        [
            'title' => 'Nutrition',
            'parent_id' => 11,
        ],
        [
            'title' => 'Yoga',
            'parent_id' => 11,
        ],
        [
            'title' => 'Mental Health',
            'parent_id' => 11,
        ],
        [
            'title' => 'Dieting',
            'parent_id' => 11,
        ],
        [
            'title' => 'Self Defense',
            'parent_id' => 11,
        ],
        [
            'title' => 'Safety & First Aid',
            'parent_id' => 11,
        ],
        [
            'title' => 'Dance',
            'parent_id' => 11,
        ],
        [
            'title' => 'Mediation',
            'parent_id' => 11,
        ],
        [
            'title' => 'Other',
            'parent_id' => 11,
        ],
        [
            'title' => 'Instruments',
            'parent_id' => 12,
        ],
        [
            'title' => 'Production',
            'parent_id' => 12,
        ],
        [
            'title' => 'Music Fundamental',
            'parent_id' => 12,
        ],
        [
            'title' => 'Vocal',
            'parent_id' => 12,
        ],
        [
            'title' => 'Music Techniques',
            'parent_id' => 12,
        ],
        [
            'title' => 'Music Software',
            'parent_id' => 12,
        ],
        [
            'title' => 'Other',
            'parent_id' => 12,
        ],
        [
            'title' => 'Engineering',
            'parent_id' => 13,
        ],
        [
            'title' => 'Humanities',
            'parent_id' => 13,
        ],
        [
            'title' => 'Math',
            'parent_id' => 13,
        ],
        [
            'title' => 'Science',
            'parent_id' => 13,
        ],
        [
            'title' => 'Online Education',
            'parent_id' => 13,
        ],
        [
            'title' => 'Social Science',
            'parent_id' => 13,
        ],
        [
            'title' => 'Language',
            'parent_id' => 13,
        ],
        [
            'title' => 'Teacher Training',
            'parent_id' => 13,
        ],
        [
            'title' => 'Test Prep',
            'parent_id' => 13,
        ],
        [
            'title' => 'Other Teaching & Academics',
            'parent_id' => 13,
        ],
        [
            'title' => 'Javascript',
            'parent_id' => 14,
        ],
        [
            'title' => 'React',
            'parent_id' => 14,
        ],
        [
            'title' => 'Angular',
            'parent_id' => 14,
        ],
        [
            'title' => 'CSS',
            'parent_id' => 14,
        ],
        [
            'title' => 'PHP',
            'parent_id' => 14,
        ],
        [
            'title' => 'NodeJs',
            'parent_id' => 14,
        ],
        [
            'title' => 'Python',
            'parent_id' => 14,
        ],
        [
            'title' => 'Wordpress',
            'parent_id' => 14,
        ],
        [
            'title' => 'Laravel',
            'parent_id' => 14,
        ],
        [
            'title' => 'O2system',
            'parent_id' => 14,
        ],
        [
            'title' => 'Codeigniter',
            'parent_id' => 14,
        ],
        [
            'title' => 'YII2',
            'parent_id' => 14,
        ],
        [
            'title' => 'Python',
            'parent_id' => 15,
        ],
        [
            'title' => 'Machine Learning',
            'parent_id' => 15,
        ],
        [
            'title' => 'Deep Learning',
            'parent_id' => 15,
        ],
        [
            'title' => 'Data Analysis',
            'parent_id' => 15,
        ],
        [
            'title' => 'Artificial Intelligence',
            'parent_id' => 15,
        ],
        [
            'title' => 'R',
            'parent_id' => 15,
        ],
        [
            'title' => 'Tensor Flow',
            'parent_id' => 15,
        ],
        [
            'title' => 'Neural Network',
            'parent_id' => 15,
        ],
        [
            'title' => 'Google Flutter',
            'parent_id' => 16,
        ],
        [
            'title' => 'Android Development',
            'parent_id' => 16,
        ],
        [
            'title' => 'IOS Development',
            'parent_id' => 16,
        ],
        [
            'title' => 'Swift',
            'parent_id' => 16,
        ],
        [
            'title' => 'React Native',
            'parent_id' => 16,
        ],
        [
            'title' => 'Dart Programing Language',
            'parent_id' => 16,
        ],
        [
            'title' => 'Mobile Development',
            'parent_id' => 16,
        ],
        [
            'title' => 'Kotlin',
            'parent_id' => 16,
        ],
        [
            'title' => 'Redux Framework',
            'parent_id' => 16,
        ],
        [
            'title' => 'Python',
            'parent_id' => 17,
        ],
        [
            'title' => 'Java',
            'parent_id' => 17,
        ],
        [
            'title' => 'C#',
            'parent_id' => 17,
        ],
        [
            'title' => 'C/C++',
            'parent_id' => 17,
        ],
        [
            'title' => 'React',
            'parent_id' => 17,
        ],
        [
            'title' => 'Javascript',
            'parent_id' => 17,
        ],
        [
            'title' => 'PHP',
            'parent_id' => 17,
        ],
        [
            'title' => 'Unity',
            'parent_id' => 18,
        ],
        [
            'title' => 'Game Development Fundamental',
            'parent_id' => 18,
        ],
        [
            'title' => 'Unreal Engine',
            'parent_id' => 18,
        ],
        [
            'title' => '3D Game Development',
            'parent_id' => 18,
        ],
        [
            'title' => 'C++',
            'parent_id' => 18,
        ],
        [
            'title' => '2D Game Development',
            'parent_id' => 18,
        ],
        [
            'title' => 'Unreal Engine Blueprint',
            'parent_id' => 18,
        ],
        [
            'title' => 'Blender',
            'parent_id' => 18,
        ],
        [
            'title' => 'SQL',
            'parent_id' => 19,
        ],
        [
            'title' => 'MySQL',
            'parent_id' => 19,
        ],
        [
            'title' => 'Oracle SQL',
            'parent_id' => 19,
        ],
        [
            'title' => 'Oracle Certification',
            'parent_id' => 19,
        ],
        [
            'title' => 'Mongo DB',
            'parent_id' => 19,
        ],
        [
            'title' => 'Apache Kafka',
            'parent_id' => 19,
        ],
        [
            'title' => 'SQL Server',
            'parent_id' => 19,
        ],
        [
            'title' => 'Database Management',
            'parent_id' => 19,
        ],
        [
            'title' => 'PostgreSQL',
            'parent_id' => 19,
        ],
        [
            'title' => 'Selenium WebDriver',
            'parent_id' => 20,
        ],
        [
            'title' => 'Java',
            'parent_id' => 20,
        ],
        [
            'title' => 'Selenium Testing Framework',
            'parent_id' => 20,
        ],
        [
            'title' => 'Automation Testing',
            'parent_id' => 20,
        ],
        [
            'title' => 'API Testing',
            'parent_id' => 20,
        ],
        [
            'title' => 'Rest Assured',
            'parent_id' => 20,
        ],
        [
            'title' => 'Appium',
            'parent_id' => 20,
        ],
        [
            'title' => 'Quality Assurance',
            'parent_id' => 20,
        ],
        [
            'title' => 'AWS Certification Developer - Associate',
            'parent_id' => 21,
        ],
        [
            'title' => 'AWS Certification',
            'parent_id' => 22,
        ],
        [
            'title' => 'Coding Interview',
            'parent_id' => 21,
        ],
        [
            'title' => 'Kubernetes',
            'parent_id' => 21,
        ],
        [
            'title' => 'Certification Kubernetes Application Developer (CKAD)',
            'parent_id' => 21,
        ],
        [
            'title' => 'MicroService',
            'parent_id' => 21,
        ],
        [
            'title' => 'Python',
            'parent_id' => 21,
        ],
        [
            'title' => 'Agile',
            'parent_id' => 21,
        ],
        [
            'title' => 'Professional Scrum Master',
            'parent_id' => 21,
        ],
        [
            'title' => 'Docker',
            'parent_id' => 22,
        ],
        [
            'title' => 'Kubernetes',
            'parent_id' => 22,
        ],
        [
            'title' => 'Git',
            'parent_id' => 22,
        ],
        [
            'title' => 'DevOps',
            'parent_id' => 22,
        ],
        [
            'title' => 'Jenkins',
            'parent_id' => 22,
        ],
        [
            'title' => 'AWS Certification',
            'parent_id' => 22,
        ],
        [
            'title' => 'AWS Certification Developer - Associate',
            'parent_id' => 22,
        ],
        [
            'title' => 'Jira',
            'parent_id' => 22,
        ],
        [
            'title' => 'NodeJs',
            'parent_id' => 22,
        ],
        [
            'title' => '.NET',
            'parent_id' => 23,
        ],
        [
            'title' => 'Shopify',
            'parent_id' => 23,
        ],
        [
            'title' => 'WooCommerce',
            'parent_id' => 23,
        ],
        [
            'title' => 'Wordpress',
            'parent_id' => 23,
        ],
        [
            'title' => 'Wordpress for Ecommerce',
            'parent_id' => 23,
        ],
        [
            'title' => 'Magento',
            'parent_id' => 23,
        ],
        [
            'title' => 'Membership Website',
            'parent_id' => 23,
        ],
        [
            'title' => 'Dropshipping',
            'parent_id' => 23,
        ],
    ];
}
