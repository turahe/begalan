<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank_gateway = [
            'enable_bank_transfer' => '1',
            'bank_name' => 'BCA',
            'bank_swift_code' => NULL,
            'account_number' => '123443423',
            'branch_name' => 'KOPO',
            'branch_address' => 'Jalan kopo no 3',
            'account_name' => 'Circle Creative',
            'iban' => 'IBM',
        ];

        $midtrans = [
            'enable_midtrans' => true,
            'test_mode' => true,
            'id_merchant' =>'G624028022',
            'client_key' =>'SB-Mid-client-OhuBYYdphvdOhY1L',
            'server_Key' => 'SB-Mid-server-Sx1oMaKFdO1FHdTj2VihS_fI',
        ];
        $payment_gateway_bank_transfer = [
            'enabled' => '1',
            'title' => 'Direct Bank Transfer',
            'description' => 'Pay via direct bank transfer to process your order',
            'instructions' => 'Please transfer your fund using following Bank Account\\r\\n\\r\\nBank Name: Bank Asia\\r\\nBranch: Mirpur circle 10\\r\\nA\\/C No: 079878765545354',
            'gateway_save_btn' => NULL,
        ];
        $payment_gateway_cod = [
            'enabled' => '1',
            'title' => 'Cash on delivery',
            'description' => 'Pay upon delivery',
            'instructions' => 'Pay upon delivery to the delivery man',
            'gateway_save_btn' => NULL,
        ];
        $withdraw_method = [
            'bank_transfer' =>
                [
                    'enable' => '1',
                    'min_withdraw_amount' => '100',
                    'notes' => 'Please note that it takes approximately 2 to 7 days to process your withdraw via bank transfer. Sometimes it may take longer. If you do not receive withdrawal after 7 days, please contact our customer support. Updated',
                ],
            'echeck' =>
                [
                    'enable' => '1',
                    'min_withdraw_amount' => '50',
                ],
            'paypal' =>
                [
                    'enable' => '1',
                    'min_withdraw_amount' => '50',
                ],
        ];

        $cookie_alert = [
            'enable' => '1',
            'message' => 'By using WebAcademy you accept our cookies and agree to our privacy policy, including cookie policy. {privacy_policy_url}',
        ];
        $social_login = [
            'facebook' =>
                [
                    'enable' => '1',
                    'app_id' => '292155035510814',
                    'app_secret' => 'de1a21d48afe669dda21626fdf638832',
                ],
            'google' =>
                [
                    'enable' => '1',
                    'client_id' => '586033023574-3m025n2jei2eldgdqf7ic2r7rh58oj86.apps.googleusercontent.com',
                    'client_secret' => 'Pd6fUp5FFmXUt-M0Prdc2fFy',
                ],
            'twitter' =>
                [
                    'enable' => '1',
                    'consumer_key' => 'iXy8T2reBWP42aD60rXdtUf8R',
                    'consumer_secret' => 'SEYSr2AFVaVfH56xPZerEZxBW7gGgZOE2CT8jdoq32BbuL7Zv3',
                ],
            'linkedin' =>
                [
                    'enable' => '1',
                    'client_id' => '86iampeb7c62rw',
                    'client_secret' => 'Gyb9naxKvOR6wM8i',
                ],
        ];

        $options = [
            'default_storage' => 'public',
            'date_format' => 'd/m/Y',
            'time_format' => 'H:i',
            'site_name' => 'WebAcademy',
            'site_title' => 'WebAcademy',
            'email_address' => 'developer@circle-creative.com',
            'default_timezone' => 'Asia/Jakarta',
            'date_format_custom' => 'd/m/Y',
            'time_format_custom' => 'H:i',
            'midtrans' => 'json_encode_value_' .json_encode($midtrans),
            'enable_stripe' => 0,
            'stripe_test_mode' => '1',
            'paypal_receiver_email' => 'admin@circle-creative.com',
            'stripe_test_secret_key' => 'sk_test_tJeAdA1KbhiYV8I8bfPmJcOL',
            'stripe_test_publishable_key' => 'pk_test_P3TFmKrvT7l29Zpyy1f4pwk8',
            'stripe_live_secret_key' => null,
            'stripe_live_publishable_key' => null,
            'enable_paypal' => 0,
            'enable_paypal_sandbox' => '1',
            'current_theme' => 'edugator',
            'copyright_text' => '[copyright_sign] [year] [site_name], All rights reserved.',
            'enable_social_login' => '1',
            'enable_facebook_login' => '1',
            'enable_google_login' => '1',
            'fb_app_id' => '807346162754117',
            'fb_app_secret' => '6b93030d5c4f2715aa9d02be93256fbd',
            'google_client_id' => '62019812075-0sp3u7h854tp7aknl1m8q7ens0pm4im0.apps.googleusercontent.com',
            'google_client_secret' => 'xK8SHn-ds4GJtVSL95ExTzw3',
            'currency_position' => 'left',
            'currency_sign' => 'IDR',
            'payment_gateway_direct-bank-transfer' =>  json_encode($payment_gateway_bank_transfer),
            'payment_gateway_cod' => json_encode($payment_gateway_cod),
            'allowed_file_types' => 'jpeg,png,jpg,pdf,zip,doc,docx,xls,ppt,mp4',
            'is_preview' => '1',
            'admin_share' => '20',
            'instructor_share' => '80',
            'charge_fees_name' => 'Payment gateway charge',
            'charge_fees_amount' => '4',
            'charge_fees_type' => 'percent',
            'enable_charge_fees' => '1',
            'enable_instructors_earning' => '1',
            'bank_gateway' => 'json_encode_value_' .json_encode($bank_gateway),
            'enable_offline_payment' => '1',
            'site_url' => url('/'),
            'withdraw_methods' => 'json_encode_value_' .json_encode($withdraw_method),
            'lms_settings' => 'json_encode_value_{"enable_discussion":"1"}',
            'active_plugins' => '{"3":"MultiInstructor","4":"StudentsProgress"}',
            'site_logo' => null,
            'terms_of_use_page' => 1,
            'privacy_policy_page' => 4,
            'about_us_page' => '3',
            'cookie_alert' => 'json_encode_value_' .json_encode($cookie_alert),
            'social_login' => 'json_encode_value_' .json_encode($social_login),
        ];

        $newOptions = [];
        foreach ($options as $key => $value) {
            $newOptions[] = ['option_key' => $key, 'option_value' => $value];
        }

        \Illuminate\Support\Facades\DB::table('options')->insert($newOptions);
    }
}
