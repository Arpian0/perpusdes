<?php

return [
'accepted'=>':attribute harus diterima / klik centang',
'active_url'=>':attribute bukan sebuah URL Valid',
'after'=>':attribute harus sebuah tanggal setelah :date',
'after_or_equal'=>':attribute harus sebuah tanggal setelah atau sama dengan :date',
'alpha'=>':attribute hanya boleh berisi huruf',
'alpha_dash'=>':attribute hanya boleh berisi huruf, nomor, tanda hubung dan underscores',
'alpha_num'=>':attribute hanya boleh berisi huruf dan nomor',
'array'=>':attribute harus sebuah array/susunan cth: [1,2,3]',
'before'=>':attribute harus sebuah tanggal sebelum :date',
'before_or_equal'=>':attribute harus sebuah tanggal sebelum atau sama dengan :date',
'between'=>[
'numeric'=>':attribute harus diantara :min dan :max',
'file'=>':attribute harus diantara :min dan :max kilobytes',
'string'=>':attribute harus diantara :min dan :max karakter',
'array'=>':attribute harus ada antara :min dan :max items',
],
'boolean'=>'kolom :attribute harus benar atau salah',
'confirmed'=>':attribute confirmation does not match',
'date'=>':attribute bukan sebuah tanggal valid',
'date_equals'=>':attribute harus sebuah tanggal sama dengan :date',
'date_format'=>':attribute tidak menyamai format :format',
'different'=>':attribute dan :other harus berbeda',
'digits'=>':attribute harus :digits angka',
'digits_between'=>':attribute harus diantara :min dan :max angka',
'dimensions'=>':attribute memiliki dimensi gambar yang tidak valid',
'distinct'=>'kolom :attribute memiliki nilai duplikat',
'email'=>'kolom :attribute harus format alamat email',
'ends_with'=>':attribute harus diakhiri dengan salah satu dari berikut ini: :values',
'exists'=>'pilihan :attribute tidak valid',
'file'=>':attribute harus sebuah file',
'filled'=>'kolom :attribute harus beriisi',
'gt'=>[
'numeric'=>':attribute harus lebih besar dari :value',
'file'=>':attribute harus lebih besar dari :value kilobytes',
'string'=>':attribute harus lebih besar dari :value karakter',
'array'=>':attribute harus memiliki lebih dari :value items',
],
'gte'=>[
'numeric'=>':attribute harus lebih besar dari atau sama dgn :value',
'file'=>':attribute harus lebih besar dari atau sama dgn :value kilobytes',
'string'=>':attribute harus lebih besar dari atau sama dgn :value karakter',
'array'=>':attribute harus punya :value items atau lebih',
],
'image'=>':attribute harus gambar',
'in'=>'pilihan :attribute tidak valid',
'in_array'=>'kolom :attribute tidak ada di :other',
'integer'=>':attribute harus bilangan bulat',
'ip'=>':attribute harus sebuah alamat IP valid',
'ipv4'=>':attribute harus sebuah alamat IPv4 valid',
'ipv6'=>':attribute harus sebuah alamat IPv6 valid',
'json'=>':attribute harus sebuah JSON string valid',
'lt'=>[
'numeric'=>':attribute harus kurang dari :value',
'file'=>':attribute harus kurang dari :value kilobytes',
'string'=>':attribute harus kurang dari :value karakter',
'array'=>':attribute harus punya kurang dari :value items',
],
'lte'=>[
'numeric'=>':attribute harus kurang dari atau sama dgn :value',
'file'=>':attribute harus kurang dari atau sama dgn :value kilobytes',
'string'=>':attribute harus kurang dari atau sama dgn :value karakter',
'array'=>':attribute tidak boleh lebih dari :value items',
],
'max'=>[
'numeric'=>':attribute mungkin tidak lebih besar dari :max',
'file'=>':attribute mungkin tidak lebih besar dari :max kilobytes',
'string'=>':attribute mungkin tidak lebih besar dari :max karakter',
'array'=>':attribute mungkin tidak memiliki lebih dari:max items',
],
'mimes'=>':attribute harus sebuah file of type: :values',
'mimetypes'=>':attribute harus sebuah file of type: :values',
'min'=>[
'numeric'=>':attribute harus setidaknya :min',
'file'=>':attribute harus setidaknya :min kilobytes',
'string'=>':attribute harus setidaknya :min karakter',
'array'=>':attribute harus punya setidaknya :min items',
],
'not_in'=>'pilihan :attribute tidak valid',
'not_regex'=>':attribute format tidak valid',
'numeric'=>':attribute harus sebuah number',
'password'=>'password salah',
'password_or_username'=>'password atau username salah',
'present'=>':attribute field harus ada',
'regex'=>':attribute format tidak valid',
'required'=>':attribute field diperlukan ',
'required_if'=>':attribute field diperlukan  saat :other adalah :value',
'required_unless'=>':attribute field diperlukan  kecuali :other memiliki :values',
'required_with'=>':attribute field diperlukan  saat :values ada',
'required_with_all'=>':attribute field diperlukan  saat :values ada',
'required_without'=>':attribute field diperlukan  saat :values tidak ada',
'required_without_all'=>':attribute field diperlukan  saat none of :values ada',
'same'=>':attribute dan :other must match',
'size'=>[
'numeric'=>':attribute harus :size',
'file'=>':attribute harus :size kilobytes',
'string'=>':attribute harus :size karakter',
'array'=>':attribute must contain :size items',
],
'starts_with'=>':attribute must start with one of following: :values',
'string'=>':attribute harus sebuah string',
'timezone'=>':attribute harus sebuah valid zone',
'unique'=>'nilai :attribute sudah diambil',
'uploaded'=>':attribute failed to upload',
'url'=>':attribute format tidak valid',
'uuid'=>':attribute harus sebuah valid UUID',

/*
|--------------------------------------------------------------------------
| Custom Validation Language Lines
|--------------------------------------------------------------------------
|
| Here you may specify custom validation messages for attributes using the
| convention "attribute.rule" to name lines. This makes it quick to
| specify a specific custom language line for a given attribute rule.
|
*/

'custom'=>[
'attribute-name'=>[
'rule-name'=>'custom-message',
],
],

'captcha'=>'captcha salah, ulangi input',
/*
|--------------------------------------------------------------------------
| Custom Validation Attributes
|--------------------------------------------------------------------------
|
| following language lines are used to swap our attribute placeholder
| with something more reader friendly such as "E-Mail Address" instead
| of "email". This simply helps us make our message more expressive.
|
*/

'attributes'=>[],

];
