<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Post;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $numberPost = sprintf("%'.03d", $i);

            $post = new Post();
            $post->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
            $post->setAuthorEmail('admin@example.com');

            $post->translate('en')->setAuthorName("EN " . $numberPost . " authorName");
            $post->translate('de')->setAuthorName("DE " . $numberPost . " authorName");

            $post->translate('en')->setTitle("EN " . $numberPost . " It is interesting article about PHP");
            $post->translate('de')->setTitle("DE " . $numberPost . " It is interesting article about PHP. It is interesting article about C#");

            $post->translate('en')->setSlug("en-" . $numberPost . "-slug");
            $post->translate('de')->setSlug("de-" . $numberPost . "-slug");

            $post->translate('en')->setPostText($this->getPostTextHtml());
            $post->translate('de')->setPostText($this->getPostTextHtml());

            $manager->persist($post);
            $post->mergeNewTranslations();

            $manager->flush();
        }
    }

    private function getPostTextHtml(): string
    {
        return "<p ><strong > Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua: Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur .
        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum .</strong >
        </p ><p ><br ></p ><ol ><li > Ut enim ad minim veniam </li ><li > Quis nostrud exercitation ullamco laboris </li ><li > Nisi ut aliquip ex ea commodo consequat </li ></ol ><p >
        <em > Praesent id fermentum lorem . Ut est lorem, fringilla at accumsan nec, euismod at nunc . Aenean mattis sollicitudin mattis . Nullam pulvinar vestibulum bibendum .
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos . Fusce nulla purus, gravida ac interdum ut, blandit eget ex . Duis aluctus dolor .</em ></p ><p >
        <u > Integer auctor massa maximus nulla scelerisque accumsan . Aliquam ac malesuada ex . Pellentesque tortor magna, vulputate eu vulputate ut, venenatis ac lectus .
            Praesent ut lacinia sem . Mauris a lectus eget felis mollis feugiat . Quisque efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue nulla vitae est .
        </u >
            Ut posuere aliquet tincidunt . Aliquam erat volutpat . Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos . Morbiarcu orci, gravida eget aliquam eu, suscipit et ante . Morbi vulputate metus vel
        ipsum finibus, ut dapibus massa feugiat . Vestibulum vel lobortis libero . Sedtincidunt tellus et viverra scelerisque . Pellentesque tincidunt cursus felis .
            Sed in egestas erat .

            Aliquam pulvinar interdum massa, vel ullamcorper ante consectetur eu . Vestibulumlacinia ac enim vel placerat . Integer pulvinar magna nec dui malesuada, nec
        congue nisl dictum . Donec mollis nisl tortor, at congue erat consequat a . Namtempus elit porta, blandit elit vel, viverra lorem . Sed sit amet tellustincidunt, faucibus nisl in, aliquet libero .</p ><p ><br ></p ><p >&lt;script & gt;alert(\"hello\") & lt;/script & gt;</p ><p ><br ></p >";
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
