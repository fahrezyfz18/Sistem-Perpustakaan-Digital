<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */


    'accepted' => ':attribute harus disetujui.',
    'accepted_if' => ':attribute harus disetujui ketika :other adalah :value.',
    'active_url' => ':attribute harus berupa URL yang valid.',
    'after' => ':attribute harus tanggal setelah :date.',
    'after_or_equal' => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, tanda hubung, dan underscore.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'any_of' => ':attribute tidak valid.',
    'array' => ':attribute harus berupa array.',
    'ascii' => ':attribute hanya boleh berisi karakter ASCII.',
    'before' => ':attribute harus tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus tanggal sebelum atau sama dengan :date.',

    'between' => [
        'array' => ':attribute harus memiliki antara :min sampai :max item.',
        'file' => ':attribute harus berukuran antara :min sampai :max kilobyte.',
        'numeric' => ':attribute harus bernilai antara :min sampai :max.',
        'string' => ':attribute harus antara :min sampai :max karakter.',
    ],

    'boolean' => ':attribute harus bernilai true atau false.',
    'can' => ':attribute mengandung nilai yang tidak diizinkan.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'contains' => ':attribute tidak memiliki nilai yang dibutuhkan.',
    'current_password' => 'Password salah.',
    'date' => ':attribute harus berupa tanggal yang valid.',
    'date_equals' => ':attribute harus sama dengan tanggal :date.',
    'date_format' => ':attribute harus sesuai format :format.',
    'decimal' => ':attribute harus memiliki :decimal angka desimal.',

    'declined' => ':attribute harus ditolak.',
    'declined_if' => ':attribute harus ditolak ketika :other adalah :value.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus :digits digit.',
    'digits_between' => ':attribute harus antara :min dan :max digit.',
    'dimensions' => 'Dimensi gambar :attribute tidak valid.',
    'distinct' => ':attribute memiliki nilai duplikat.',

    'doesnt_contain' => ':attribute tidak boleh mengandung: :values.',
    'doesnt_end_with' => ':attribute tidak boleh diakhiri dengan: :values.',
    'doesnt_start_with' => ':attribute tidak boleh diawali dengan: :values.',

    'email' => ':attribute harus berupa email yang valid.',
    'encoding' => ':attribute harus dienkode dalam :encoding.',
    'ends_with' => ':attribute harus diakhiri dengan: :values.',
    'enum' => ':attribute yang dipilih tidak valid.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'extensions' => ':attribute harus memiliki ekstensi: :values.',
    'file' => ':attribute harus berupa file.',
    'filled' => ':attribute harus memiliki nilai.',

    'gt' => [
        'array' => ':attribute harus memiliki lebih dari :value item.',
        'file' => ':attribute harus lebih besar dari :value kilobyte.',
        'numeric' => ':attribute harus lebih besar dari :value.',
        'string' => ':attribute harus lebih dari :value karakter.',
    ],

    'gte' => [
        'array' => ':attribute harus memiliki minimal :value item.',
        'file' => ':attribute harus lebih besar atau sama dengan :value kilobyte.',
        'numeric' => ':attribute harus lebih besar atau sama dengan :value.',
        'string' => ':attribute harus lebih besar atau sama dengan :value karakter.',
    ],

    'hex_color' => ':attribute harus berupa warna hex yang valid.',
    'image' => ':attribute harus berupa gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute harus ada dalam :other.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'ip' => ':attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':attribute harus berupa IPv4 yang valid.',
    'ipv6' => ':attribute harus berupa IPv6 yang valid.',
    'json' => ':attribute harus berupa JSON yang valid.',

    'max' => [
        'array' => ':attribute tidak boleh lebih dari :max item.',
        'file' => ':attribute tidak boleh lebih dari :max kilobyte.',
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
    ],

    'min' => [
        'array' => ':attribute minimal memiliki :min item.',
        'file' => ':attribute minimal :min kilobyte.',
        'numeric' => ':attribute minimal :min.',
        'string' => ':attribute minimal :min karakter.',
    ],

    'numeric' => ':attribute harus berupa angka.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => ':attribute wajib diisi.',
    'required_if' => ':attribute wajib diisi.',
    'required_with' => ':attribute wajib diisi ketika :values ada.',
    'same' => ':attribute harus sama dengan :other.',
    'string' => ':attribute harus berupa teks.',

    'unique' => ':attribute sudah digunakan.',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => ':attribute harus berupa URL yang valid.',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan khusus',
        ],
    ],

    'attributes' => [
        'email' => 'Email',
        'password' => 'Password',
        'name' => 'Nama',
    ],

];