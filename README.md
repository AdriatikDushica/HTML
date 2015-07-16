# Simple HTML Builder for PHP



    $builder = new \Dushica\Html\Builder();
    
    $builder
        ->html()
            ->head()
            ->end()
    
            ->body()
                ->a(['href'=>'http://google.com'])
                    ->text('Google link')
                ->end()
            ->end()
        ->end();
    
    echo $builder;