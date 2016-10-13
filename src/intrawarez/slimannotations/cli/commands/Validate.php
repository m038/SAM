<?php
namespace intrawarez\slimannotations\cli\commands;

use Doctrine\Common\Annotations\AnnotationReader;
use intrawarez\slimannotations\metadata\ClassMetadata;
use intrawarez\slimannotations\metadata\MetadataFactory;
use intrawarez\slimannotations\metadata\MetadataLoader;
use intrawarez\slimannotations\metadata\MethodMetadata;
use intrawarez\slimannotations\parser\Parser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Validate extends Command
{
    protected function configure()
    {
        $this
        ->setName("validate")
        ->setDescription("Validates the mapping in a given directory.")
        ->addArgument("dir");
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        
        $output->getFormatter()->setStyle('error', new OutputFormatterStyle("red", null, []));
        $output->getFormatter()->setStyle('warning', new OutputFormatterStyle("yellow", null, []));
        $output->getFormatter()->setStyle('success', new OutputFormatterStyle("cyan", null, []));

        $parser = new Parser();
        $reader = new AnnotationReader();
        $factory = new MetadataFactory($reader);
        $loader = new MetadataLoader($parser, $factory);
        
        $dir = $input->getArgument("dir");
        
        $io->title("Validating: '$dir'");
        
        $classMetadatas = $loader->loadDir($dir);
        
        $headers = ["#","Level","Error"];
        
        foreach ($classMetadatas as $classMetadata) {
            /**
             * @var ClassMetadata $classMetadata
             */
            $className = $classMetadata->getReflectionClass()->getName();
            $classShortName = $classMetadata->getReflectionClass()->getShortName();
            
            $io->section($className);
            
            if ($classMetadata->isGroupDeclaration()) {
                $rows = [];
                
                if ($this->groupHasNoMappedMethods($classMetadata)){
                    $rows[] = [
                        count($rows)+1,
                        "<warning>WARING</warning>",
                        "Group <info>$classShortName</info> has no mapped methods!",
                    ];
                }
                
                foreach ($classMetadata->getMethodMetadata() as $methodMetadata) {
                    /**
                     * @var MethodMetadata $methodMetadata
                     */
                    $methodName = $methodMetadata->getReflectionMethod()->getName();
                    
                    if ($this->groupMethodIsNotPublic($methodMetadata)) {
                        $rows[] = [
                            count($rows)+1,
                            "<error>ERROR</error>",
                            "Mapped method <info>$methodName</info> is not public!",
                        ];
                    }
                    
                }
                
                if (count($rows) > 0) {
                    $io->error("Invalid Group-Mapping in class $classShortName");
                    $io->table($headers, $rows);
                } else {
                    $io->success("Group-Mapping in $classShortName is Valid!");
                }
                
                
            } elseif ($classMetadata->isActionDeclaration()) {
                $rows = [];
                
                if ($this->actionDoesNotImplementInvoke($classMetadata)) {
                    if ($this->groupMethodIsNotPublic($methodMetadata)) {
                        $rows[] = [
                            count($rows)+1,
                            "<error>ERROR</error>",
                            "Mapped ACTION class <info>$classShortName</info> does not implement __invoke!",
                        ];
                    }
                }
                
                if (count($rows) > 0) {
                    $io->error("Invalid Action-Mapping in class $classShortName");
                    $io->table($headers, $rows);
                } else {
                    $io->success("Action-Mapping in $classShortName is Valid!");
                }
            }
        }
    }
    
    private function groupHasNoMappedMethods(ClassMetadata $classMetadata): bool
    {
        return count($classMetadata->getMethodMetadata()) == 0;
    }
    
    private function groupMethodIsNotPublic(MethodMetadata $methodMetadata): bool
    {
        return !$methodMetadata->getReflectionMethod()->isPublic();
    }
    
    private function actionDoesNotImplementInvoke(ClassMetadata $classMetadata)
    {
        $reflectionClass = $classMetadata->getReflectionClass();
        return !(
            $reflectionClass->isInstantiable()
            && in_array(
                "__invoke",
                array_map(
                    function (\ReflectionMethod $method) {
                        return strtolower($method->getName());
                    }, 
                    $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC)
                )
            )
        );
        
    }
}
