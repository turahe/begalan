<?php

function dashboard_menu()
{
    $menu = [];

    //$menu['route_name'] = 'value';

    $user = \Illuminate\Support\Facades\Auth::user();

    if (auth()->user()->hasRole('instructor')) {
        $pendingDiscusionBadge = '';
        $pendingDiscussionCount = $user->instructor_discussions->where('replied', 0)->count();
        if ($pendingDiscussionCount) {
            $pendingDiscusionBadge = "<span class='badge badge-warning float-right'> {$pendingDiscussionCount} </span>";
        }

        $menu = apply_filters('dashboard_menu_for_instructor', [
            'create_course' => [
                'name' => __('admin.create_new_course'),
                'icon' => '<i class="las la-chalkboard-teacher"></i>',
                'is_active' => request()->is('dashboard/courses/new'),
            ],
            'my_courses' => [
                'name' => __('admin.my_courses'),
                'icon' => '<i class="las la-graduation-cap"></i>',
                'is_active' => request()->is('dashboard/my-courses'),
            ],
            'earning' => [
                'name' => __('admin.earnings'),
                'icon' => '<i class="las la-comment-dollar"></i>',
                'is_active' => request()->is('dashboard/earning*'),
            ],
            'withdraw' => [
                'name' => __('admin.withdraw'),
                'icon' => '<i class="las la-wallet"></i>',
                'is_active' => request()->is('dashboard/withdraw*'),
            ],
            'my_courses_reviews' => [
                'name' => __('admin.my_courses_reviews'),
                'icon' => '<i class="las la-star"></i>',
                'is_active' => request()->is('dashboard/my-courses-reviews*'),
            ],
            'courses_has_quiz' => [
                'name' => __('admin.quiz_attempts'),
                'icon' => '<i class="las la-check-double"></i>',
                'is_active' => request()->is('dashboard/courses-has-quiz*'),
            ],
            'courses_has_assignments' => [
                'name' => __('admin.assignments'),
                'icon' => '<i class="las la-star"></i>',
                'is_active' => request()->is('dashboard/assignments*'),
            ],
            'instructor_discussions' => [
                'name' => __('admin.discussions').$pendingDiscusionBadge,
                'icon' => '<i class="las la-question-circle-o"></i>',
                'is_active' => request()->is('dashboard/discussions*'),
            ],
        ]);
    }

    $menu = $menu + apply_filters('dashboard_menu_for_users', [
        'enrolled_courses' => [
            'name' => __('admin.enrolled_courses'),
            'icon' => '<i class="las la-pencil-square-o"></i>',
            'is_active' => request()->is('dashboard/enrolled-courses*'),
        ],
        'wishlist' => [
            'name' => __('admin.wishlist'),
            'icon' => '<i class="las la-heart-o"></i>',
            'is_active' => request()->is('dashboard/wishlist*'),
        ],
        'reviews_i_wrote' => [
            'name' => __('admin.reviews'),
            'icon' => '<i class="las la-star-half-alt"></i>',
            'is_active' => request()->is('dashboard/reviews-i-wrote*'),
        ],
        'my_quiz_attempts' => [
            'name' => __('admin.my_quiz_attempts'),
            'icon' => '<i class="las la-question-circle-o"></i>',
            'is_active' => request()->is('dashboard/my-quiz-attempts*'),
        ],
        'purchase_history' => [
            'name' => __('admin.purchase_history'),
            'icon' => '<i class="las la-history"></i>',
            'is_active' => request()->is('dashboard/purchases*'),
        ],
        'profile_settings' => [
            'name' => __('admin.settings'),
            'icon' => '<i class="las la-tools"></i>',
            'is_active' => request()->is('dashboard/settings*'),
        ],
    ]);

    if (auth()->user()->hasRole('admin')) {
        $menu['admin'] = [
            'name' => __('admin.go_to_admin'),
            'icon' => '<i class="las la-cogs"></i>',
        ];
    }

    return apply_filters('dashboard_menu_items', $menu);
}

function course_edit_navs()
{
    $nav_items = apply_filters('course_edit_nav_items', [
        'edit_course_information' => [
            'name' => __('admin.information'),
            'icon' => '<i class="las la-info-circle"></i>',
            'is_active' => request()->is('dashboard/courses/*/information'),
        ],
        'edit_course_curriculum' => [
            'name' => __('admin.curriculum'),
            'icon' => '<i class="las la-th-list"></i>',
            'is_active' => request()->is('dashboard/courses/*/curriculum'),
        ],
        'edit_course_pricing' => [
            'name' => __('admin.pricing'),
            'icon' => '<i class="las la-cart-arrow-down"></i>',
            'is_active' => request()->is('dashboard/courses/*/pricing'),
        ],
        'edit_course_drip' => [
            'name' => __('admin.drip'),
            'icon' => '<i class="las la-fill-drip"></i>',
            'is_active' => request()->is('dashboard/courses/*/drip'),
        ],

    ]);

    return $nav_items;
}
