<?php

    return [
        'title' => 'Account verification',
        'main' => [
            'surname' => 'Last name, as in passport',
            'name' => 'Name, as in passport',
            'phone' => 'Contact phone:',
            'document' => 'Passport series and number without spaces:',
            'photo' => 'Upload your photo, which should look like this: <br>
            You are holding a passport in your hand so that you can read your full name and take pictures with it.
            Make sure that the photo is clear and all information is clearly visible - this will speed up processing
            data. '
        ],
        'multi-accs' => [
            'title' => 'Choose the correct option for your answer about registering an account on
            website <a href=":href">monexo-invest.com</a>:',
            'answers' => [
                '1' => 'I have only created one account - mine.',
                '2' => 'I helped with registration and created several accounts, but for myself -
                only one.',
                '3' => 'Yes, I created more than one for myself and didn’t know I shouldn’t do that.',
                '4' => 'Another person created my account for me.'
            ]
        ],
        'attention' => 'Attention! After completing the answers to the questions in this account, you will also
        it is imperative to log into all your other accounts and go to
        their verification in their own name ',
        'accs-list' => 'Please list all your accounts:',
        'verif-truth' => 'You confirm that you need
        be sure to go to all your accounts and go through verification on
        own name',
        'verif-rules' => 'Do you confirm that you answered all questions truthfully?',
        'verif-phone' => 'Verify online',
        'verif-document' => 'Pass passport verification',
        'errors' => [
            'validation' => [
                'required' => [
                    'surname' => 'The "Surname" field is required',
                    'name' => 'The "Name" field is required',
                    'birthday' => 'The field "Date of birth" is required',
                    'phone_anket' => 'The "Contact phone" field is required',
                    'document' => 'The field "Series and number of the passport" is required',
                    'photo' => 'You forgot to attach your passport photo',
                    'multi_accounts' => 'You forgot to answer the question about multi-accounts',
                    'multi_emails_list' => 'You have not specified email for fake accounts',
                    'truth-anwers' => 'You must confirm that you answered the questions truthfully',
                    'truth-rules' => 'You must confirm that you will be verified on other accounts as well',
                ]
            ],
            'photo' => 'Error uploading photo',
            'not-email' => 'Account with email :email does not exist in the system'
        ],
        'success' =>' Your account is under verification, please wait. Verification takes place manually, so it will take some time. The process can take several days due to the large number of questionnaires. We apologize for the inconvenience.'
    ];