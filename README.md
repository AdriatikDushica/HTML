# Simple HTML Builder for PHP



    $builder = new Dushica\Html\Builder;

    // By default are 'input' and 'br'
    $builder->setNoClose(['input', 'br', 'hr']);

    //Add one more tag that not must be closed
    $builder->addNoClose('link');

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