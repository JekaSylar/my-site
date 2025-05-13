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

    'accepted' => 'Поле :attribute має бути прийняте.',
    'accepted_if' => 'Поле :attribute має бути прийняте, коли :other є :value.',
    'active_url' => 'Поле :attribute має бути дійсною URL-адресою.',
    'after' => 'Поле :attribute має бути датою після :date.',
    'after_or_equal' => 'Поле :attribute має бути датою після або рівною :date.',
    'alpha' => 'Поле :attribute має містити лише літери.',
    'alpha_dash' => 'Поле :attribute має містити лише літери, цифри, дефіси та підкреслення.',
    'alpha_num' => 'Поле :attribute має містити лише літери та цифри.',
    'any_of' => 'Поле :attribute є недійсним.',
    'array' => 'Поле :attribute має бути масивом.',
    'ascii' => 'Поле :attribute має містити лише однобайтові алфавітно-цифрові символи та знаки.',
    'before' => 'Поле :attribute має бути датою до :date.',
    'before_or_equal' => 'Поле :attribute має бути датою до або рівною :date.',
    'between' => [
        'array' => 'Поле :attribute має містити від :min до :max елементів.',
        'file' => 'Поле :attribute має бути розміром від :min до :max кілобайт.',
        'numeric' => 'Поле :attribute має бути від :min до :max.',
        'string' => 'Поле :attribute має містити від :min до :max символів.',
    ],
    'boolean' => 'Поле :attribute має бути true або false.',
    'can' => 'Поле :attribute містить неавторизоване значення.',
    'confirmed' => 'Підтвердження поля :attribute не збігається.',
    'contains' => 'У полі :attribute відсутнє обов’язкове значення.',
    'current_password' => 'Пароль неправильний.',
    'date' => 'Поле :attribute має бути дійсною датою.',
    'date_equals' => 'Поле :attribute має бути датою, рівною :date.',
    'date_format' => 'Поле :attribute має відповідати формату :format.',
    'decimal' => 'Поле :attribute має містити :decimal десяткових знаків.',
    'declined' => 'Поле :attribute має бути відхилене.',
    'declined_if' => 'Поле :attribute має бути відхилене, коли :other є :value.',
    'different' => 'Поле :attribute та :other мають бути різними.',
    'digits' => 'Поле :attribute має містити :digits цифр.',
    'digits_between' => 'Поле :attribute має містити від :min до :max цифр.',
    'dimensions' => 'Поле :attribute має недійсні розміри зображення.',
    'distinct' => 'Поле :attribute має дубльоване значення.',
    'doesnt_end_with' => 'Поле :attribute не повинно закінчуватися одним із наступних: :values.',
    'doesnt_start_with' => 'Поле :attribute не повинно починатися з одного з наступних: :values.',
    'email' => 'Поле :attribute має бути дійсною адресою електронної пошти.',
    'ends_with' => 'Поле :attribute має закінчуватися одним із наступних: :values.',
    'enum' => 'Вибране :attribute є недійсним.',
    'exists' => 'Вибране :attribute є недійсним.',
    'extensions' => 'Поле :attribute має мати одне з наступних розширень: :values.',
    'file' => 'Поле :attribute має бути файлом.',
    'filled' => 'Поле :attribute має мати значення.',
    'gt' => [
        'array' => 'Поле :attribute має містити більше ніж :value елементів.',
        'file' => 'Поле :attribute має бути більшим за :value кілобайт.',
        'numeric' => 'Поле :attribute має бути більшим за :value.',
        'string' => 'Поле :attribute має містити більше ніж :value символів.',
    ],
    'gte' => [
        'array' => 'Поле :attribute має містити :value або більше елементів.',
        'file' => 'Поле :attribute має бути більшим або рівним :value кілобайт.',
        'numeric' => 'Поле :attribute має бути більшим або рівним :value.',
        'string' => 'Поле :attribute має містити :value або більше символів.',
    ],
    'hex_color' => 'Поле :attribute має бути дійсним шістнадцятковим кольором.',
    'image' => 'Поле :attribute має бути зображенням.',
    'in' => 'Вибране :attribute є недійсним.',
    'in_array' => 'Поле :attribute має існувати в :other.',
    'integer' => 'Поле :attribute має бути цілим числом.',
    'ip' => 'Поле :attribute має бути дійсною IP-адресою.',
    'ipv4' => 'Поле :attribute має бути дійсною IPv4-адресою.',
    'ipv6' => 'Поле :attribute має бути дійсною IPv6-адресою.',
    'json' => 'Поле :attribute має бути дійсним JSON-рядком.',
    'list' => 'Поле :attribute має бути списком.',
    'lowercase' => 'Поле :attribute має бути в нижньому регістрі.',
    'lt' => [
        'array' => 'Поле :attribute має містити менше ніж :value елементів.',
        'file' => 'Поле :attribute має бути меншим за :value кілобайт.',
        'numeric' => 'Поле :attribute має бути меншим за :value.',
        'string' => 'Поле :attribute має містити менше ніж :value символів.',
    ],
    'lte' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :value елементів.',
        'file' => 'Поле :attribute має бути меншим або рівним :value кілобайт.',
        'numeric' => 'Поле :attribute має бути меншим або рівним :value.',
        'string' => 'Поле :attribute має містити :value або менше символів.',
    ],
    'mac_address' => 'Поле :attribute має бути дійсною MAC-адресою.',
    'max' => [
        'array' => 'Поле :attribute не повинно містити більше ніж :max елементів.',
        'file' => 'Поле :attribute не повинно бути більшим за :max кілобайт.',
        'numeric' => 'Поле :attribute не повинно бути більшим за :max.',
        'string' => 'Поле :attribute не повинно містити більше ніж :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно містити більше ніж :max цифр.',
    'mimes' => 'Поле :attribute має бути файлом типу: :values.',
    'mimetypes' => 'Поле :attribute має бути файлом типу: :values.',
    'min' => [
        'array' => 'Поле :attribute має містити щонайменше :min елементів.',
        'file' => 'Поле :attribute має бути щонайменше :min кілобайт.',
        'numeric' => 'Поле :attribute має бути щонайменше :min.',
        'string' => 'Поле :attribute має містити щонайменше :min символів.',
    ],
    'min_digits' => 'Поле :attribute має містити щонайменше :min цифр.',
    'missing' => 'Поле :attribute має бути відсутнім.',
    'missing_if' => 'Поле :attribute має бути відсутнім, коли :other є :value.',
    'missing_unless' => 'Поле :attribute має бути відсутнім, якщо :other не є :value.',
    'missing_with' => 'Поле :attribute має бути відсутнім, коли :values присутнє.',
    'missing_with_all' => 'Поле :attribute має бути відсутнім, коли :values присутні.',
    'multiple_of' => 'Поле :attribute має бути кратним :value.',
    'not_in' => 'Вибране :attribute є недійсним.',
    'not_regex' => 'Формат поля :attribute є недійсним.',
    'numeric' => 'Поле :attribute має бути числом.',
    'password' => [
        'letters' => 'Поле :attribute має містити щонайменше одну літеру.',
        'mixed' => 'Поле :attribute має містити щонайменше одну велику та одну малу літеру.',
        'numbers' => 'Поле :attribute має містити щонайменше одну цифру.',
        'symbols' => 'Поле :attribute має містити щонайменше один символ.',
        'uncompromised' => 'Вказане :attribute з’явилося в витоку даних. Будь ласка, виберіть інше :attribute.',
    ],
    'present' => 'Поле :attribute має бути присутнім.',
    'present_if' => 'Поле :attribute має бути присутнім, коли :other є :value.',
    'present_unless' => 'Поле :attribute має бути присутнім, якщо :other не є :value.',
    'present_with' => 'Поле :attribute має бути присутнім, коли :values присутнє.',
    'present_with_all' => 'Поле :attribute має бути присутнім, коли :values присутні.',
    'prohibited' => 'Поле :attribute заборонено.',
    'prohibited_if' => 'Поле :attribute заборонено, коли :other є :value.',
    'prohibited_if_accepted' => 'Поле :attribute заборонено, коли :other прийняте.',
    'prohibited_if_declined' => 'Поле :attribute заборонено, коли :other відхилене.',
    'prohibited_unless' => 'Поле :attribute заборонено, якщо :other не є в :values.',
    'prohibits' => 'Поле :attribute забороняє присутність :other.',
    'regex' => 'Формат поля :attribute є недійсним.',
    'required' => 'Поле :attribute є обов’язковим.',
    'required_array_keys' => 'Поле :attribute має містити записи для: :values.',
    'required_if' => 'Поле :attribute є обов’язковим, коли :other є :value.',
    'required_if_accepted' => 'Поле :attribute є обов’язковим, коли :other прийняте.',
    'required_if_declined' => 'Поле :attribute є обов’язковим, коли :other відхилене.',
    'required_unless' => 'Поле :attribute є обов’язковим, якщо :other не є в :values.',
    'required_with' => 'Поле :attribute є обов’язковим, коли :values присутнє.',
    'required_with_all' => 'Поле :attribute є обов’язковим, коли :values присутні.',
    'required_without' => 'Поле :attribute є обов’язковим, коли :values відсутнє.',
    'required_without_all' => 'Поле :attribute є обов’язковим, коли жодне з :values не присутнє.',
    'same' => 'Поле :attribute має збігатися з :other.',
    'size' => [
        'array' => 'Поле :attribute має містити :size елементів.',
        'file' => 'Поле :attribute має бути :size кілобайт.',
        'numeric' => 'Поле :attribute має бути :size.',
        'string' => 'Поле :attribute має містити :size символів.',
    ],
    'starts_with' => 'Поле :attribute має починатися з одного з наступних: :values.',
    'string' => 'Поле :attribute має бути рядком.',
    'timezone' => 'Поле :attribute має бути дійсним часовим поясом.',
    'unique' => 'Значення :attribute уже зайняте.',
    'uploaded' => 'Не вдалося завантажити :attribute.',
    'uppercase' => 'Поле :attribute має бути у верхньому регістрі.',
    'url' => 'Поле :attribute має бути дійсною URL-адресою.',
    'ulid' => 'Поле :attribute має бути дійсним ULID.',
    'uuid' => 'Поле :attribute має бути дійсним UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
