<?php
namespace Odt\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;


class CafCommand extends Command 
{
    protected function configure() {
         $this
            ->setName('caf:test')
            ->setDescription("Ceci est une commande de test")
             /*
             ->addArgument(
                'fichiers',
                InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                'Les noms de fichier MOF à traiter'
                )*/
            ->addOption(
               'test1',
               null,
               InputOption::VALUE_NONE ,
               'Premier test avec un fichier word'
                )            ->addOption(
               'test2',
               null,
               InputOption::VALUE_NONE ,
               'Générer un fichier PDF depuis une modele'
                )

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        // Définition des propriétés pour générer les pdf
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('vendor/tecnickcom/tcpdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF'); 

      
        //Affihag des données
        $style = new OutputFormatterStyle('red', 'yellow', array('bold', 'blink'));
        $output->getFormatter()->setStyle('fire', $style);
        $titre = "<fire>Ceci est une commande de test</fire>";
        $output->writeln($titre);

        if( $input->getOption('test1')){
          $this->test1('hello');
        } elseif ($input->getOption('test2')) {
          $this->test2('template/Annexe2.docx', 'DepuisModele');
        }

    }

    /**
     *
     * Test pour essayer word
     * @var none
     * @return none
     */
    private function test1($name, $rep='output')
    {
      // Creating the new document...
      $phpWord = new \PhpOffice\PhpWord\PhpWord();
      // Adding an empty Section to the document...
      $section = $phpWord->addSection();
      // Adding Text element to the Section having font styled by default...
      $section->addText(
          '"Learn from yesterday, live for today, hope for tomorrow. '
              . 'The important thing is not to stop questioning." '
              . '(Albert Einstein)'
      );


      $section->addText('Local image without any styles:');
      $section->addImage('template/img/logo.jpg');

      // Saving the document as ODF file...
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
      $fileName = $rep  . DIRECTORY_SEPARATOR . $name . '.docx';
      $objWriter->save($fileName);
      //Save it
      $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
      $fileNamePDF = $rep  . DIRECTORY_SEPARATOR . $name . '.pdf';
      $xmlWriter->save($fileNamePDF); 
      
      // Saving the document as HTML file...
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
      $fileNameHtml = $rep  . DIRECTORY_SEPARATOR . $name . '.html';
      $objWriter->save($fileNameHtml);

      //Load temp file
      $phpWord = \PhpOffice\PhpWord\IOFactory::load($fileName); 







    }

    /**
     *
     * Générer un pdf depuis un template
     * @var none
     * @return none
     */
    private function test2($template, $name, $rep='output')
    {
      $phpWord = new \PhpOffice\PhpWord\PhpWord();

      //Open template and save it as docx
      $document = $phpWord->loadTemplate($template);
      $fileNameTemp = 'temp' . DIRECTORY_SEPARATOR . $name . '.docx';
      $document->saveAs($fileNameTemp);

      //Load temp file
      $phpWord = \PhpOffice\PhpWord\IOFactory::load($fileNameTemp); 

      // Saving the document as HTML file...
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
      $fileNameHtml = $rep  . DIRECTORY_SEPARATOR . $name . '.html';
      $objWriter->save($fileNameHtml);


      //Save it
      $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
      $fileNamePDF = $rep  . DIRECTORY_SEPARATOR . $name . '.pdf';
      $xmlWriter->save($fileNamePDF); 
    }


    
}
