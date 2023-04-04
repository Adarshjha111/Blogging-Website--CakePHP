<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        @media 
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            
            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            
            tr { border: 1px solid #ccc; }
            
            td { 
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%; 
            }
            
            td:before { 
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
            }
            
            /*
            Label the data
            */
            
            td:nth-of-type(2):before { content: "Created"; }
            td:nth-of-type(3):before { content: "Actions"; }
        }


    </style>


</head>


<h1>Blog articles</h1>
<p><?= $this->Html->link('Add Article', ['action' => 'add']) ?></p>
<table>
    <thead>
        <tr>
            
            <th>Title</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>

    <!-- Here's where we loop through our $articles query object, printing out article info -->
    <?php 
        $this->loadHelper('Authentication.Identity');
    ?>
        <?php foreach ($articles as $article): ?>
            <tbody>
                <tr>
                    <td>
                        <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
                    </td>
                    <td>
                        <?= $article->created->format(DATE_RFC850) ?>
                    </td>
                    <?php
                    
                        if($article->email === $email) 

                        {      
                    ?>
                    <td>
                        <?= $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $article->id],
                            ['confirm' => 'Are you sure?'])
                        ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
                    </td>
                    <?php  } 


                    else 
                        {

                    ?>
                            <td>
                                <?= $this->Html->link('View', ['action' => 'view', $article->id]) ?>
                            </td>

                    <?php }  ?>

                </tr>
            </tbody>
        <?php endforeach; ?>

</table>
