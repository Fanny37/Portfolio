<?php

namespace App\DataFixtures;

use App\Entity\AboutMe;
use App\Entity\Illustration;
use App\Entity\Project;
use App\Entity\Techno;
use App\Entity\Timeline;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\HtmlLorem;
use Faker\Provider\Lorem;

class AppFixtures extends Fixture
{
    private $slugger;

    public function __construct(Slugify $slugify)
    {
        $this->slugger = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        //AboutMe
        $aboutMe = new AboutMe();
        $aboutMe->setTitle('Fanny Lemaitre-Hermenier')
            ->setFunction('Développeuse Web')
            ->setEmail('flemaitre37@gmail.com')
            ->setGithubLink('https://github.com/Fanny37')
            ->setDescription('Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus soluta debitis pariatur nemo hic quam voluptates maxime rem tenetur, accusantium explicabo est magni veniam quo optio minima earum. Doloribus, animi.')
            ->setAvatar('https://zupimages.net/up/21/17/otsc.png');

        $manager->persist($aboutMe);

        //Timeline
        $year = 2017;
        for ($i = 0; $i < 5; $i++) {
            $timeline = new Timeline();
            $timeline->setYear($year + $i)
            ->setDescription($faker->paragraph(5));

            $manager->persist($timeline);
        }
    
        //Technos
        $technos = ['PHP', 'JavaScript', 'Symfony', 'React', 'Node', 'Bootstrap', 'WebPack Encore', 'Methode SCRUM'];
        $technosPersist = [];
        foreach ($technos as $techno) {
            $new = new Techno();
            $new->setName($techno);

            $manager->persist($new);
            $technosPersist[] = $new;
        }

        //Projects
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();
            $project->setTitle($faker->sentence())
            ->setSlug($this->slugger->generate($project->getTitle()))
            ->setPitch($faker->paragraph(1))
            ->setDescription($faker->paragraph(3))
            ->addTechno($faker->randomElement($technosPersist))
            ->addTechno($faker->randomElement($technosPersist))
            ->addTechno($faker->randomElement($technosPersist))
            ->setGithubLink($faker->domainName())
            ->setWebsiteLink($faker->domainName())
            ->setCreatedAt($faker->dateTime())
            ->setIllustration('https://zupimages.net/up/21/17/otsc.png');

            for ($j = 0; $j < 5; $j++) {
                $illustration = new Illustration();
                $illustration->setImage('https://zupimages.net/up/21/17/otsc.png')
                ->setProject($project);
                $manager->persist($illustration);

                $project->addGallery($illustration);
            }

            $manager->persist($project);
        }

        $manager->flush();
    }
}
