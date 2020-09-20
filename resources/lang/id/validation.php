<?php

return [

    /*
   |---------------------------------------------------------------------------------------
   | Baris Bahasa untuk Validasi
   |---------------------------------------------------------------------------------------
   |
   | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
   | kelas validasi. Beberapa aturan mempunyai banyak versi seperti aturan 'size'.
   | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
   |
   */

    'accepted'        => ':Attribute harus diterima.',
    'active_url'      => ':Attribute bukan URL yang valid.',
    'after'           => ':Attribute harus berisi tanggal setelah :date.',
    'after_or_equal'  => ':Attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha'           => ':Attribute hanya boleh berisi huruf.',
    'alpha_dash'      => ':Attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'       => ':Attribute hanya boleh berisi huruf dan angka.',
    'array'           => ':Attribute harus berisi sebuah array.',
    'before'          => ':Attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => ':Attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between'         => [
        'numeric' => ':Attribute harus bernilai antara :min sampai :max.',
        'file'    => ':Attribute harus berukuran antara :min sampai :max kilobita.',
        'string'  => ':Attribute harus berisi antara :min sampai :max karakter.',
        'array'   => ':Attribute harus memiliki :min sampai :max anggota.',
    ],
    'boolean'        => ':Attribute harus bernilai true atau false',
    'confirmed'      => 'Konfirmasi :attribute tidak cocok.',
    'date'           => ':Attribute bukan tanggal yang valid.',
    'date_equals'    => ':Attribute harus berisi tanggal yang sama dengan :date.',
    'date_format'    => ':Attribute tidak cocok dengan format :format.',
    'different'      => ':Attribute dan :other harus berbeda.',
    'digits'         => ':Attribute harus terdiri dari :digits angka.',
    'digits_between' => ':Attribute harus terdiri dari :min sampai :max angka.',
    'dimensions'     => ':Attribute tidak memiliki dimensi gambar yang valid.',
    'distinct'       => ':Attribute memiliki nilai yang duplikat.',
    'email'          => ':Attribute harus berupa alamat surel yang valid.',
    'ends_with'      => ':Attribute harus diakhiri salah satu dari berikut: :values',
    'exists'         => ':Attribute yang dipilih tidak valid.',
    'file'           => ':Attribute harus berupa sebuah berkas.',
    'filled'         => ':Attribute harus memiliki nilai.',
    'gt'             => [
        'numeric' => ':Attribute harus bernilai lebih besar dari :value.',
        'file'    => ':Attribute harus berukuran lebih besar dari :value kilobita.',
        'string'  => ':Attribute harus berisi lebih besar dari :value karakter.',
        'array'   => ':Attribute harus memiliki lebih dari :value anggota.',
    ],
    'gte' => [
        'numeric' => ':Attribute harus bernilai lebih besar dari atau sama dengan :value.',
        'file'    => ':Attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
        'string'  => ':Attribute harus berisi lebih besar dari atau sama dengan :value karakter.',
        'array'   => ':Attribute harus terdiri dari :value anggota atau lebih.',
    ],
    'image'    => ':Attribute harus berupa gambar.',
    'in'       => ':Attribute yang dipilih tidak valid.',
    'in_array' => ':Attribute tidak ada di dalam :other.',
    'integer'  => ':Attribute harus berupa bilangan bulat.',
    'ip'       => ':Attribute harus berupa alamat IP yang valid.',
    'ipv4'     => ':Attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'     => ':Attribute harus berupa alamat IPv6 yang valid.',
    'json'     => ':Attribute harus berupa JSON string yang valid.',
    'lt'       => [
        'numeric' => ':Attribute harus bernilai kurang dari :value.',
        'file'    => ':Attribute harus berukuran kurang dari :value kilobita.',
        'string'  => ':Attribute harus berisi kurang dari :value karakter.',
        'array'   => ':Attribute harus memiliki kurang dari :value anggota.',
    ],
    'lte' => [
        'numeric' => ':Attribute harus bernilai kurang dari atau sama dengan :value.',
        'file'    => ':Attribute harus berukuran kurang dari atau sama dengan :value kilobita.',
        'string'  => ':Attribute harus berisi kurang dari atau sama dengan :value karakter.',
        'array'   => ':Attribute harus tidak lebih dari :value anggota.',
    ],
    'max' => [
        'numeric' => ':Attribute maksimal bernilai :max.',
        'file'    => ':Attribute maksimal berukuran :max kilobita.',
        'string'  => ':Attribute maksimal berisi :max karakter.',
        'array'   => ':Attribute maksimal terdiri dari :max anggota.',
    ],
    'mimes'     => ':Attribute harus berupa berkas berjenis: :values.',
    'mimetypes' => ':Attribute harus berupa berkas berjenis: :values.',
    'min'       => [
        'numeric' => ':Attribute minimal bernilai :min.',
        'file'    => ':Attribute minimal berukuran :min kilobita.',
        'string'  => ':Attribute minimal berisi :min karakter.',
        'array'   => ':Attribute minimal terdiri dari :min anggota.',
    ],
    'not_in'               => ':Attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format :attribute tidak valid.',
    'numeric'              => ':Attribute harus berupa angka.',
    'password'             => 'Kata sandi salah.',
    'present'              => ':Attribute wajib ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => ':Attribute wajib diisi.',
    'required_if'          => ':Attribute wajib diisi bila :other adalah :value.',
    'required_unless'      => ':Attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => ':Attribute wajib diisi bila terdapat :values.',
    'required_with_all'    => ':Attribute wajib diisi bila terdapat :values.',
    'required_without'     => ':Attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => ':Attribute wajib diisi bila sama sekali tidak terdapat :values.',
    'same'                 => ':Attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => ':Attribute harus berukuran :size.',
        'file'    => ':Attribute harus berukuran :size kilobyte.',
        'string'  => ':Attribute harus berukuran :size karakter.',
        'array'   => ':Attribute harus mengandung :size anggota.',
    ],
    'starts_with' => ':Attribute harus diawali salah satu dari berikut: :values',
    'string'      => ':Attribute harus berupa string.',
    'timezone'    => ':Attribute harus berisi zona waktu yang valid.',
    'unique'      => ':Attribute sudah ada sebelumnya.',
    'uploaded'    => ':Attribute gagal diunggah.',
    'url'         => 'Format :attribute tidak valid.',
    'uuid'        => ':Attribute harus merupakan UUID yang valid.',

    // Custom app validations
//     'full_name_required'            => 'Your name is required',
    'composite_unique'              => 'The :attribute :value already exists.',
    'register_email_unique'         => 'This email address already has an account. Please try something else.',
    'role_type_required'            => 'Select role type.',
    'attribute_id_required'         => 'Select attribute.',
    'attribute_type_id_required'    => 'Select attribute type.',
    'attribute_code_required'       => 'The attribute code field is required.',
    'attribute_value_required'      => 'The attribute value field is required.',
    'category_list_required'        => 'Select at least one category.',
    'manufacturer_required'         => 'The manufacturer field is required.',
    'origin_required'               => 'The origin field is required.',
    'offer_start_required'          => 'When you have an offer price, the offer start date is required.',
    'offer_start_after'             => ' The promotion start time can\'t be a past time.',
    'offer_end_required'            => 'When you have an offer price, the offer end date is required.',
    'offer_end_after'               => ' The offer end time must be a time after the offer start time.',
    'variants_required'             => 'Variants required',
    'sku-unique'                    => 'The sku :value has already been taken. Try new one.',
    'sku-distinct'                  => 'Variant :attribute has a duplicate sku value.',
    'offer_price-numeric'           => ' is not a valid price value. The offer price must be a number.',
    'email_template_id_required'    => 'Email template is required.',
    'merchant_have_shop'            => 'This merchant have a shop.',
    'brand_logo_max'                => 'The brand logo may not be greater than :max kilobytes.',
    'brand_logo_mimes'              => 'The brand logo must be a file of type: :values.',
    'avatar_required'               => 'Choose an avatar.',
    'subject_required_without'      => 'The subject is required if you dont use a template.',
    'message_required_without'      => 'The message is required if you dont use a template.',
    'template_id_required_without_all'=> 'Select a template or composer a new message.',
    'customer_required'             => 'Select a customer.',
    'reply_required_without' => 'The reply filed is required.',
    'template_id_required_without'=> 'Select a template is required when repling with template.',
    'shipping_zone_tax_id_required' => 'Select the tax profile for the zone',
    'shipping_zone_country_ids_required' => 'Select at least one country',
    'rest_of_the_world_composite_unique' => 'The rest of the world shipping zone already exists.',
    'something_went_wrong' => 'Something is not right. Please check and try again.',
    'shipping_rate_required_unless' => 'Give a shipping rate or select \'Free shipping\' option',
    'shipping_range_minimum_min' => 'Minimum range can\'t be negative value',
    'shipping_range_maximum_min' => 'Maximum range can\'t be less than minimum value',
    'csv_mimes'                => 'The :attribute must be a file of type csv.',
    'import_data_required' => 'The dataset is not valid to import. Please check your data and try again.',
    'do_action_required'    => 'You didn\'t provide the input.',
    'do_action_invalid'    => 'The given keyword/input is not valid.',
    'recaptcha'=>'Please ensure that you are a human!',

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi untuk atribut sesuai keinginan dengan
    | menggunakan konvensi "attribute.rule" dalam penamaan barisnya. Hal ini mempercepat
    | dalam menentukan baris bahasa kustom yang spesifik untuk aturan atribut yang diberikan.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar 'placeholder' atribut dengan sesuatu
    | yang lebih mudah dimengerti oleh pembaca seperti "Alamat Surel" daripada "surel" saja.
    | Hal ini membantu kita dalam membuat pesan menjadi lebih ekspresif.
    |
    */

    'attributes' => [
    ],
];
