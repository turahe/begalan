<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    Mail::send('welcome', [], function ($message) {
        $message->to('sparrow.dewa@gmail.com')->subject('Testing mails');
    });
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('clear', [\App\Http\Controllers\HomeController::class, 'clearCache'])->name('clear_cache');

Route::get('installations', [\App\Http\Controllers\InstallationController::class, 'installations'])->name('installations');
Route::get('installations/step/2', [\App\Http\Controllers\InstallationController::class, 'installationsTwo'])->name('installations_step_two');
Route::post('installations/step/2', [\App\Http\Controllers\InstallationController::class, 'installationPost']);
Route::get('installations/step/final', [\App\Http\Controllers\InstallationController::class, 'installationFinal'])->name('installation_final');

/*
 * Authentication
 */

//Route::get('login', 'AuthController@login')->name('login')->middleware('guest');
//Route::post('login', 'AuthController@loginPost');
//Route::any('logout', 'AuthController@logoutPost')->name('logout');

//Route::get('register', 'AuthController@register')->name('register')->middleware('guest');
//Route::post('register', 'AuthController@registerPost');
//Route::get('email/verify', 'AuthController@userVerified')->name('verification.notice');
//Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

//Route::get('forgot-password', 'AuthController@forgotPassword')->name('forgot_password');
//Route::post('forgot-password', 'AuthController@sendResetToken');
//Route::get('forgot-password/reset/{token}', 'AuthController@passwordResetForm')->name('reset_password_link');
//Route::post('forgot-password/reset/{token}', 'AuthController@passwordReset');

Route::get('profile/{id}', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('review/{id}', [\App\Http\Controllers\UserController::class, 'review'])->name('review');

Route::get('courses', [\App\Http\Controllers\HomeController::class, 'courses'])->name('courses');
Route::get('featured-courses', [\App\Http\Controllers\HomeController::class, 'courses'])->name('featured_courses');
Route::get('popular-courses', [\App\Http\Controllers\HomeController::class, 'courses'])->name('popular_courses');

Route::get('courses/{slug?}', [\App\Http\Controllers\CourseController::class, 'view'])->name('course');
Route::get('courses/{slug}/lecture/{lecture_id}', [\App\Http\Controllers\CourseController::class, 'lectureView'])->name('single_lecture');
Route::get('courses/{slug}/assignment/{assignment_id}', [\App\Http\Controllers\CourseController::class, 'assignmentView'])->name('single_assignment');
Route::get('courses/{slug}/quiz/{quiz_id}', [\App\Http\Controllers\QuizController::class, 'quizView'])->name('single_quiz');

Route::get('topics', [\App\Http\Controllers\CategoriesController::class, 'home'])->name('categories');
Route::get('topics/{category_slug}', [\App\Http\Controllers\CategoriesController::class, 'show'])->name('category_view');
//Get Topics Dropdown for course creation category select
Route::post('get-topic-options', [\App\Http\Controllers\CategoriesController::class, 'getTopicOptions'])->name('get_topic_options');

Route::post('courses/free-enroll', [\App\Http\Controllers\CourseController::class, 'freeEnroll'])->name('free_enroll');

//Attachment Download
Route::get('attachment-download/{hash}', [\App\Http\Controllers\CourseController::class, 'attachmentDownload'])->name('attachment_download');

Route::get('payment-thank-you', [\App\Http\Controllers\PaymentController::class, 'thankYou'])->name('payment_thank_you_page');

//Route::group(['prefix'=>'login'], function () {
//    //Social login route
//    Route::get('facebook', 'AuthController@redirectFacebook')->name('facebook_redirect');
//    Route::get('facebook/callback', 'AuthController@callbackFacebook')->name('facebook_callback');
//
//    Route::get('google', 'AuthController@redirectGoogle')->name('google_redirect');
//    Route::get('google/callback', 'AuthController@callbackGoogle')->name('google_callback');
//
//    Route::get('twitter', 'AuthController@redirectTwitter')->name('twitter_redirect');
//    Route::get('twitter/callback', 'AuthController@callbackTwitter')->name('twitter_callback');
//
//    Route::get('linkedin', 'AuthController@redirectLinkedIn')->name('linkedin_redirect');
//    Route::get('linkedin/callback', 'AuthController@callbackLinkedIn')->name('linkin_callback');
//});

Route::group(['middleware' => ['auth']], function () {
    // Notifications
    Route::get('notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
    Route::get('notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'show'])->name('notifications.show');
    Route::get('notifications.markAsRead', [\App\Http\Controllers\NotificationController::class, 'markAllNotificationsAsRead'])->name('notifications.markAllAsRead')->middleware('ajax');
    Route::delete('notifications/{notification}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.delete');
    Route::delete('notifications', [\App\Http\Controllers\NotificationController::class, 'destroyAll'])->name('notifications.deleteAll');

//    Courses
    Route::post('courses/{slug}/assignment/{assignment_id}', [\App\Http\Controllers\CourseController::class, 'assignmentSubmitting']);
    Route::get('content_complete/{content_id}', [\App\Http\Controllers\CourseController::class, 'contentComplete'])->name('content_complete');
    Route::post('courses-complete/{course_id}', [\App\Http\Controllers\CourseController::class, 'complete'])->name('course_complete');

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
        Route::get('/payment/{id}', [\App\Http\Controllers\CartController::class, 'payment'])->name('checkout_payment');
        Route::post('bank-transfer', [\App\Http\Controllers\GatewayController::class, 'bankPost'])->name('bank_transfer_submit');
        Route::post('choose-payment-method', [\App\Http\Controllers\GatewayController::class, 'choosePaymentMethod'])->name('choose_payment_method');
        Route::post('paypal', [\App\Http\Controllers\GatewayController::class, 'paypalRedirect'])->name('paypal_redirect');
        Route::post('offline', [\App\Http\Controllers\GatewayController::class, 'payOffline'])->name('pay_offline');
    });

    Route::post('save-review/{course_id?}', [\App\Http\Controllers\CourseController::class, 'writeReview'])->name('save_review');
    Route::post('update-wishlist', [\App\Http\Controllers\UserController::class, 'updateWishlist'])->name('update_wish_list');

    Route::post('discussion/ask-question', [\App\Http\Controllers\DiscussionController::class, 'askQuestion'])->name('ask_question');
    Route::post('discussion/reply/{id}', [\App\Http\Controllers\DiscussionController::class, 'replyPost'])->name('discussion_reply_student');

    Route::post('quiz-start', [\App\Http\Controllers\QuizController::class, 'start'])->name('start_quiz');
    Route::get('quiz/{id}', [\App\Http\Controllers\QuizController::class, 'quizAttempting'])->name('quiz_attempt_url');
    Route::post('quiz/{id}', [\App\Http\Controllers\QuizController::class, 'answerSubmit']);

    //Route::get('quiz/answer/submit', 'QuizController@answerSubmit')->name('quiz_answer_submit');
});

/*
 * Add and remove to Cart
 */
Route::post('add-to-cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('add_to_cart');
Route::post('remove-cart', [\App\Http\Controllers\CartController::class, 'removeCart'])->name('remove_cart');

/*
 * Payment Gateway Silent Notification
 * CSRF verification skipped
 */
Route::group(['prefix' => 'gateway-ipn'], function () {
    Route::post('stripe', [\App\Http\Controllers\GatewayController::class, 'stripeCharge'])->name('stripe_charge');
    Route::post('midtrans', [\App\Http\Controllers\GatewayController::class, 'midtransCharge'])->name('midtrans_submit');
    Route::any('paypal/{transaction_id?}', [\App\Http\Controllers\GatewayController::class, 'paypalNotify'])->name('paypal_notify');
});

/*
 * Users,Instructor dashboard area
 */

Route::group(['prefix'=>'dashboard', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    /*
     * Only instructor has access in this group
     */
    Route::group(['middleware' => ['instructor']], function () {
        Route::post('update-section/{id}', [\App\Http\Controllers\CourseController::class, 'updateSection'])->name('update_section');
        Route::post('delete-section', [\App\Http\Controllers\CourseController::class, 'deleteSection'])->name('delete_section');

        Route::group(['prefix' => 'courses'], function () {
            Route::get('new', [\App\Http\Controllers\CourseController::class, 'create'])->name('create_course');
            Route::post('new', [\App\Http\Controllers\CourseController::class, 'store']);

            Route::get('{course_id}/information', [\App\Http\Controllers\CourseController::class, 'information'])->name('edit_course_information');
            Route::post('{course_id}/information', [\App\Http\Controllers\CourseController::class, 'informationPost']);

            Route::group(['prefix' => '{course_id}/curriculum'], function () {
                Route::get('', [\App\Http\Controllers\CourseController::class, 'curriculum'])->name('edit_course_curriculum');
                Route::get('new-section', [\App\Http\Controllers\CourseController::class, 'newSection'])->name('new_section');
                Route::post('new-section', [\App\Http\Controllers\CourseController::class, 'newSectionPost']);

                Route::post('new-lecture', [\App\Http\Controllers\CourseController::class, 'newLecture'])->name('new_lecture');
                Route::post('update-lecture/{id}', [\App\Http\Controllers\CourseController::class, 'updateLecture'])->name('update_lecture');

                Route::post('new-assignment', [\App\Http\Controllers\CurriculumController::class, 'newAssignment'])->name('new_assignment');
                Route::post('update-assignment/{id}', [\App\Http\Controllers\CurriculumController::class, 'updateAssignment'])->name('update_assignment');

                Route::group(['prefix' => 'quiz'], function () {
                    Route::post('create', [\App\Http\Controllers\QuizController::class, 'newQuiz'])->name('new_quiz');
                    Route::post('update/{id}', [\App\Http\Controllers\QuizController::class, 'updateQuiz'])->name('update_quiz');

                    Route::post('{quiz_id}/create-question', [\App\Http\Controllers\QuizController::class, 'createQuestion'])->name('create_question');
                });
            });

            Route::post('quiz/edit-question', [\App\Http\Controllers\QuizController::class, 'editQuestion'])->name('edit_question_form');
            Route::post('quiz/update-question', [\App\Http\Controllers\QuizController::class, 'updateQuestion'])->name('edit_question');
            Route::post('load-quiz-questions', [\App\Http\Controllers\QuizController::class, 'loadQuestions'])->name('load_questions');
            Route::post('sort-questions', [\App\Http\Controllers\QuizController::class, 'sortQuestions'])->name('sort_questions');
            Route::post('delete-question', [\App\Http\Controllers\QuizController::class, 'deleteQuestion'])->name('delete_question');
            Route::post('delete-option', [\App\Http\Controllers\QuizController::class, 'deleteOption'])->name('option_delete');

            Route::post('edit-item', [\App\Http\Controllers\CourseController::class, 'editItem'])->name('edit_item_form');
            Route::post('delete-item', [\App\Http\Controllers\CourseController::class, 'deleteItem'])->name('delete_item');
            Route::post('curriculum_sort', [\App\Http\Controllers\CurriculumController::class, 'sort'])->name('curriculum_sort');

            Route::post('delete-attachment', [\App\Http\Controllers\CurriculumController::class, 'deleteAttachment'])->name('delete_attachment_item');

            Route::post('load-section-items', [\App\Http\Controllers\CourseController::class, 'loadContents'])->name('load_contents');

            Route::get('{id}/pricing', [\App\Http\Controllers\CourseController::class, 'pricing'])->name('edit_course_pricing');
            Route::post('{id}/pricing', [\App\Http\Controllers\CourseController::class, 'pricingSet']);
            Route::get('{id}/drip', [\App\Http\Controllers\CourseController::class, 'drip'])->name('edit_course_drip');
            Route::post('{id}/drip', [\App\Http\Controllers\CourseController::class, 'dripPost']);
            Route::get('{id}/publish', [\App\Http\Controllers\CourseController::class, 'publish'])->name('publish_course');
            Route::post('{id}/publish', [\App\Http\Controllers\CourseController::class, 'publishPost']);
        });

        Route::get('my-courses', [\App\Http\Controllers\CourseController::class, 'myCourses'])->name('my_courses');
        Route::get('my-courses-reviews', [\App\Http\Controllers\CourseController::class, 'myCoursesReviews'])->name('my_courses_reviews');

        Route::group(['prefix' => 'courses-has-quiz'], function () {
            Route::get('/', [\App\Http\Controllers\QuizController::class, 'quizCourses'])->name('courses_has_quiz');
            Route::get('quizzes/{id}', [\App\Http\Controllers\QuizController::class, 'quizzes'])->name('courses_quizzes');
            Route::get('attempts/{quiz_id}', [\App\Http\Controllers\QuizController::class, 'attempts'])->name('quiz_attempts');
            Route::get('attempt/{attempt_id}', [\App\Http\Controllers\QuizController::class, 'attemptDetail'])->name('attempt_detail');
            Route::post('attempt/{attempt_id}', [\App\Http\Controllers\QuizController::class, 'attemptReview']);
        });

        Route::group(['prefix' => 'assignments'], function () {
            Route::get('/', [\App\Http\Controllers\AssignmentController::class, 'index'])->name('courses_has_assignments');
            Route::get('course/{course_id}', [\App\Http\Controllers\AssignmentController::class, 'assignmentsByCourse'])->name('courses_assignments');
            Route::get('submissions/{assignment_id}', [\App\Http\Controllers\AssignmentController::class, 'submissions'])->name('assignment_submissions');
            Route::get('submission/{submission_id}', [\App\Http\Controllers\AssignmentController::class, 'submission'])->name('assignment_submission');
            Route::post('submission/{submission_id}', [\App\Http\Controllers\AssignmentController::class, 'evaluation']);
        });

        Route::group(['prefix' => 'earning'], function () {
            Route::get('/', [\App\Http\Controllers\EarningController::class, 'earning'])->name('earning');
            Route::get('report', [\App\Http\Controllers\EarningController::class, 'earningReport'])->name('earning_report');
        });
        Route::group(['prefix' => 'withdraw'], function () {
            Route::get('/', [\App\Http\Controllers\EarningController::class, 'withdraw'])->name('withdraw');
            Route::post('/', [\App\Http\Controllers\EarningController::class, 'withdrawPost']);

            Route::get('preference', [\App\Http\Controllers\EarningController::class, 'withdrawPreference'])->name('withdraw_preference');
            Route::post('preference', [\App\Http\Controllers\EarningController::class, 'withdrawPreferencePost']);
        });

        Route::group(['prefix'=>'discussions'], function () {
            Route::get('/', [\App\Http\Controllers\DiscussionController::class, 'index'])->name('instructor_discussions');
            Route::get('reply/{id}', [\App\Http\Controllers\DiscussionController::class, 'reply'])->name('discussion_reply');
            Route::post('reply/{id}', [\App\Http\Controllers\DiscussionController::class, 'replyPost']);
        });
    });

    Route::group(['prefix'=>'media'], function () {
        Route::post('upload', [\App\Http\Controllers\MediaController::class, 'store'])->name('post_media_upload');
        Route::get('load_filemanager', [\App\Http\Controllers\MediaController::class, 'loadFileManager'])->name('load_filemanager');
        Route::post('delete', [\App\Http\Controllers\MediaController::class, 'delete'])->name('delete_media');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [\App\Http\Controllers\DashboardController::class, 'profileSettings'])->name('profile_settings');
        Route::post('/', [\App\Http\Controllers\DashboardController::class, 'profileSettingsPost']);

        Route::get('reset-password', [\App\Http\Controllers\DashboardController::class, 'resetPassword'])->name('profile_reset_password');
        Route::post('reset-password', [\App\Http\Controllers\DashboardController::class, 'resetPasswordPost']);
    });

    Route::get('enrolled-courses', [\App\Http\Controllers\DashboardController::class, 'enrolledCourses'])->name('enrolled_courses');
    Route::get('reviews-i-wrote', [\App\Http\Controllers\DashboardController::class, 'myReviews'])->name('reviews_i_wrote');
    Route::get('wishlist', [\App\Http\Controllers\DashboardController::class, 'wishlist'])->name('wishlist');

    Route::get('my-quiz-attempts', [\App\Http\Controllers\QuizController::class, 'myQuizAttempts'])->name('my_quiz_attempts');

    Route::group(['prefix' => 'purchases'], function () {
        Route::get('/', [\App\Http\Controllers\DashboardController::class, 'purchaseHistory'])->name('purchase_history');
        Route::get('view/{id}', [\App\Http\Controllers\DashboardController::class, 'purchaseView'])->name('purchase_view');
    });
});

/*
 * Admin Area
 */

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');

    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    Route::group(['prefix'=>'media_manager'], function () {
        Route::get('/', [\App\Http\Controllers\MediaController::class, 'mediaManager'])->name('media_manager');
        Route::post('media-update', [\App\Http\Controllers\MediaController::class, 'mediaManagerUpdate'])->name('media_update');
    });

    Route::group(['prefix'=>'courses'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'adminCourses'])->name('admin_courses');
        Route::get('popular', [\App\Http\Controllers\Admin\AdminController::class, 'popularCourses'])->name('admin_popular_courses');
        Route::get('featured', [\App\Http\Controllers\Admin\AdminController::class, 'featureCourses'])->name('admin_featured_courses');
    });

//    Route::group(['prefix' => 'plugins'], function () {
//        Route::get('/', 'ExtendController@plugins')->name('plugins');
//        Route::get('find', 'ExtendController@findPlugins')->name('find_plugins');
//        Route::get('action', 'ExtendController@pluginAction')->name('plugin_action');
//    });
//    Route::group(['prefix' => 'themes'], function () {
//        Route::get('/', 'ExtendController@themes')->name('themes');
//        Route::post('activate', 'ExtendController@activateTheme')->name('activate_theme');
//        Route::get('find', 'ExtendController@findThemes')->name('find_themes');
//    });

    Route::group(['prefix'=>'settings'], function () {
        Route::get('theme-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'ThemeSettings'])->name('theme_settings');
        Route::get('invoice-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'invoiceSettings'])->name('invoice_settings');
        Route::get('general', [\App\Http\Controllers\Admin\SettingsController::class, 'GeneralSettings'])->name('general_settings');
        Route::get('lms-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'LMSSettings'])->name('lms_settings');

        Route::get('social', [\App\Http\Controllers\Admin\SettingsController::class, 'SocialSettings'])->name('social_settings');
        //Save settings / options
        Route::post('save-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('save_settings');
        Route::get('payment', [\App\Http\Controllers\PaymentController::class, 'PaymentSettings'])->name('payment_settings');
        Route::get('storage', [\App\Http\Controllers\Admin\SettingsController::class, 'StorageSettings'])->name('storage_settings');
    });

    Route::get('gateways', [\App\Http\Controllers\PaymentController::class, 'PaymentGateways'])->name('payment_gateways');
    Route::get('withdraw', [\App\Http\Controllers\Admin\SettingsController::class, 'withdraw'])->name('withdraw_settings');

    Route::group(['prefix'=>'payments'], function () {
        Route::get('/', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payments');
        Route::get('view/{id}', [\App\Http\Controllers\PaymentController::class, 'view'])->name('payment_view');
        Route::get('delete/{id}', [\App\Http\Controllers\PaymentController::class, 'delete'])->name('payment_delete');

        Route::post('update-status/{id}', [\App\Http\Controllers\PaymentController::class, 'updateStatus'])->name('update_status');
    });

    Route::group(['prefix'=>'withdraws'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'withdrawsRequests'])->name('withdraws');
    });

    Route::group(['prefix'=>'users'], function () {
        Route::get('/', ['as'=>'users', 'uses' => [\App\Http\Controllers\UserController::class, 'users']]);
//        Route::get('create', ['as'=>'add_administrator', 'uses' => 'UserController@addAdministrator']);
//        Route::post('create', ['uses' => 'UserController@storeAdministrator']);

//        Route::post('block-unblock', ['as'=>'administratorBlockUnblock', 'uses' => 'UserController@administratorBlockUnblock']);
    });

    /*
     * Change Password route
     */
    Route::group(['prefix' => 'account'], function () {
        Route::get('change-password', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('change_password');
        Route::post('change-password', [\App\Http\Controllers\UserController::class, 'changePasswordPost']);
    });
});

/*
 * Single Page
 */
//Route::get('{slug}', 'PostController@singlePage')->name('page');

Route::get('blog', [\App\Http\Controllers\PostController::class, 'blog'])->name('blog');
Route::get('blog/{slug}', [\App\Http\Controllers\PostController::class, 'postSingle'])->name('post');
Route::get('post/{id?}', [\App\Http\Controllers\PostController::class, 'postProxy'])->name('post_proxy');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
