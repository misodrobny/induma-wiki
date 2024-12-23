<?php

return [
    'pages' => [
        'login' => [
            'login' => 'Log in',
            'password' => 'Password',
            'remember_me' => 'Remember me',
            'forgot_your_password' => 'Forgot your password?',
            'forgot_your_password_text' => 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
            'version' => 'Version',
            'email' => 'E-mail',
            'email_reset_link' => 'Email Password Reset Link',
        ],
        'profile' => [
            'notifications' => [
                'password_changed_heading' => 'Password has been changed.',
                'password_changed_text' => 'Your password has been successfully changed.',
                'profile_changed_heading' => 'Profile has been updated.',
                'profile_changed_text' => 'The information on your profile has been updated.',
            ],
            'update_password' => 'Update Password',
            'update_password_text' => 'Ensure your account uses a long, random password to stay secure.',
            'current_password' => 'Current Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'singular' => 'Profile',
            'profile_info' => 'Profile Information',
            'profile_info_text' => 'Update the profile information for your account.',
            'verified' => [
                'not_verified' => 'Your email address is not verified.',
                'button' => 'Click here to resend the verification email.',
                'confirmation' => 'A new verification link has been sent to your email address.',
            ],
        ],
        'documents' => [
            'actions' => [
                'process_data' => 'Upload the document to process data for LLM',
                'sync' => 'Sync status of the document',
                'show_json_data' => 'Show JSON Data',
            ],
            'upload' => [
                'header' => 'Upload document',
                'description' => 'Upload PDF, which you would like to process for use in Induma Wiki',
                'document_file' => 'Document file',
                'name' => 'Document name',
                'upload_file_text' => 'Upload a file',
                'upload_file_max_size_text' => 'PDF up to 20MB',
                'messages' => [
                    'success' => [
                        'stored' => 'Document was successfully stored.',
                    ],
                    'error' => [
                        'stored' => 'Unable to store the document.',
                    ],
                ],
            ],
            'table' => [
                'messages' => [
                    'success' => [
                        'process_for_llm_started' => 'Data processing triggered for LLM. Please wait for the result.',
                        'sync_document_data_for_llm' => 'Syncing document data for LLM started. Please wait for the result.',
                    ],
                    'error' => [
                        'unable_to_start' => 'Unable to process data for LLM.',
                        'unable_to_sync' => 'Unable to sync document data for LLM.',
                    ],
                ],
            ],
        ],
    ],
];
