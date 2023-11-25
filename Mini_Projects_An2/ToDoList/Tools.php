<?php
    $data = [
        1=>[
          'userId' => 737,
          'todos' => 'hello world',
          'completed' => 'true',

        ],

        2=>[
          'userId' => 733,
          'todos' => 'hello dddd',
          'completed' => 'false',

        ],
        3=>[
          'userId' => 13,
          'todos' => 'learn',
          'completed' => 'true',

        ],
        4=>[
          'userId' => 15,
          'todos' => 'hello javascript',
          'completed' => 'false',

        ],
        
        5=>[
          'userId' => 43,
          'todos' => 'hello php',
          'completed' => 'true',

        ]

        ];

    function getData(){
        global $data;
        return $data;
    }

?>