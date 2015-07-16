# Simple HTML Builder for PHP



    $builder = new Dushica\Html\Builder;

    $builder->setNoClose(['input', 'br', 'hr']);

    $builder
        ->html()

            ->body()
                
                ->text('Insert your Firstname: ')
                
                ->br()
                
                ->input(['placeholder'=>'Firstname'])
                
                ->hr()
                
                ->text('Insert your Lastname: ')
                
                ->br()
                
                ->input(['placeholder'=>'Lastname'])

            ->end()
        
        ->end();

    echo $builder;