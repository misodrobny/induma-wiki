<?php

return [
    'pages' => [
        'login' => [
            'login' => 'Iniciar sesión',
            'password' => 'Contraseña',
            'remember_me' => 'Recuérdame',
            'forgot_your_password' => '¿Olvidaste tu contraseña?',
            'forgot_your_password_text' => '¿Olvidaste tu contraseña? No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña y puedas elegir una nueva.',
            'version' => 'Versión',
            'email' => 'Correo electrónico',
            'email_reset_link' => 'Enviar enlace de restablecimiento de contraseña',
        ],
        'profile' => [
            'notifications' => [
                'password_changed_heading' => 'La contraseña ha sido cambiada.',
                'password_changed_text' => 'Tu contraseña se ha cambiado exitosamente.',
                'profile_changed_heading' => 'El perfil ha sido actualizado.',
                'profile_changed_text' => 'La información de tu perfil ha sido actualizada.',
            ],
            'update_password' => 'Actualizar contraseña',
            'update_password_text' => 'Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.',
            'current_password' => 'Contraseña actual',
            'new_password' => 'Nueva contraseña',
            'confirm_password' => 'Confirmar contraseña',
            'singular' => 'Perfil',
            'profile_info' => 'Información del perfil',
            'profile_info_text' => 'Actualiza la información del perfil de tu cuenta.',
            'verified' => [
                'not_verified' => 'Tu dirección de correo electrónico no está verificada.',
                'button' => 'Haz clic aquí para reenviar el correo de verificación.',
                'confirmation' => 'Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.',
            ],
        ],
        'documents' => [
            'actions' => [
                'process_data' => 'Subir el documento para procesar datos para LLM',
                'sync' => 'Sincronizar el estado del documento',
                'show_json_data' => 'Mostrar datos JSON',
            ],
            'upload' => [
                'header' => 'Subir documento',
                'description' => 'Sube un PDF que te gustaría procesar para usar en Induma Wiki',
                'document_file' => 'Archivo del documento',
                'name' => 'Nombre del documento',
                'upload_file_text' => 'Subir un archivo',
                'upload_file_max_size_text' => 'PDF de hasta 20MB',
                'messages' => [
                    'success' => [
                        'stored' => 'El documento se almacenó correctamente.',
                    ],
                    'error' => [
                        'stored' => 'No se pudo almacenar el documento.',
                    ],
                ],
            ],
            'table' => [
                'messages' => [
                    'success' => [
                        'process_for_llm_started' => 'El procesamiento de datos para LLM ha comenzado. Por favor espera el resultado.',
                        'sync_document_data_for_llm' => 'La sincronización de datos del documento para LLM ha comenzado. Por favor espera el resultado.',
                    ],
                    'error' => [
                        'unable_to_start' => 'No se pudo procesar los datos para LLM.',
                        'unable_to_sync' => 'No se pudo sincronizar los datos del documento para LLM.',
                    ],
                ],
            ],
        ],
        'dashboard' => [
            'widgets' => [
                'total_number_of_documents' => 'Número total de documentos',
            ],
        ],
    ],
];
