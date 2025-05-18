<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Comment;
use App\Entity\Playlist;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // ARTISTS
        $artist1 = new Artist();
        $artist1->setName('The Beatles');
        $artist1->setPhoto('the-beatles (2).jpg');
        $manager->persist($artist1);

        $artist2 = new Artist();
        $artist2->setName('Coldplay');
        $artist2->setPhoto('coldplay (1).jpg');
        $manager->persist($artist2);

        // ALBUMS
        $album1 = new Album();
        $album1->setTitle('Abbey Road');
        $album1->setArtist($artist1);
        $album1->setCoverImage('the-beatles (1).jpg');
        $manager->persist($album1);

        $album2 = new Album();
        $album2->setTitle('Parachutes');
        $album2->setArtist($artist2);
        $album2->setCoverImage('coldplay (2).jpg');
        $manager->persist($album2);

        // USERS
        $user1 = new User();
        $user1->setEmail('alice@example.com');
        $user1->setFirstname('Alice');
        $user1->setLastname('Dupont');
        $user1->setPseudo('aDupont');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->hasher->hashPassword($user1, 'password123'));
        $user1->setProfilePicture('icons8-user-96.png');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('bob@example.com');
        $user2->setFirstname('Bob');
        $user2->setLastname('Moretti');
        $user2->setPseudo('bMoretti');
        $user2->setRoles(['ROLE_BANNED']);
        $user2->setPassword($this->hasher->hashPassword($user2, 'password123'));
        $user2->setProfilePicture('icons8-user-96.png');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('baptiste@example.com');
        $user3->setFirstname('Baptiste');
        $user3->setLastname('Vasseur');
        $user3->setPseudo('bVasseur');
        $user3->setRoles(['ROLE_ADMIN']);
        $user3->setPassword($this->hasher->hashPassword($user3, 'password123'));
        $user3->setProfilePicture('icons8-user-96.png');
        $manager->persist($user3);

        // PLAYLIST
        $playlist = new Playlist();
        $playlist->setName('Favorites');
        $playlist->setUserPlaylist($user1);
        $playlist->addAlbum($album1);
        $playlist->addAlbum($album2);
        $manager->persist($playlist);

        // COMMENTS
        $comment1 = new Comment();
        $comment1->setContent('Great album!');
        $comment1->setAlbum($album1);
        $comment1->setUserComment($user1);
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent('Love this song');
        $comment2->setAlbum($album2);
        $comment2->setUserComment($user2);
        $manager->persist($comment2);

        $manager->flush();
    }
}
