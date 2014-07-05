<?php

return array(
    'images' => array(

        'paths' => array(
            'input' => 'app/storage/useruploads',
            'output' => 'app/storage/cache/images'
        ),

        'sizes' => array(
            'small' => array(
                'width' => 150,
                'height' => 100
            ),
            'big' => array(
                'width' => 600,
                'height' => 400
            )
        )
    )

);