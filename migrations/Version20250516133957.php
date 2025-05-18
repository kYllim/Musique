<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250516133957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_39986E43B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, album_id INT NOT NULL, user_comment_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526C1137ABCF (album_id), INDEX IDX_9474526C5F0EBBFF (user_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, user_playlist_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D782112DAFA018DD (user_playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE playlist_album (playlist_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_9A8477006BBD148 (playlist_id), INDEX IDX_9A8477001137ABCF (album_id), PRIMARY KEY(playlist_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE album ADD CONSTRAINT FK_39986E43B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526C1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526C5F0EBBFF FOREIGN KEY (user_comment_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE playlist ADD CONSTRAINT FK_D782112DAFA018DD FOREIGN KEY (user_playlist_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE playlist_album ADD CONSTRAINT FK_9A8477006BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE playlist_album ADD CONSTRAINT FK_9A8477001137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE album DROP FOREIGN KEY FK_39986E43B7970CF8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1137ABCF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526C5F0EBBFF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DAFA018DD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE playlist_album DROP FOREIGN KEY FK_9A8477006BBD148
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE playlist_album DROP FOREIGN KEY FK_9A8477001137ABCF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE album
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE artist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE comment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE playlist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE playlist_album
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
