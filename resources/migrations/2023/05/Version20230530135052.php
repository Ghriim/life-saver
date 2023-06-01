<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530135052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `BOOK` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE BOOK_TO_AUTHOR (bookdto_id INT NOT NULL, bookauthordto_id INT NOT NULL, INDEX IDX_E21B8262504AA872 (bookdto_id), INDEX IDX_E21B8262444A6044 (bookauthordto_id), PRIMARY KEY(bookdto_id, bookauthordto_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `BOOK_AUTHOR` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `BOOK_REVIEW` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', evaluation INT NOT NULL, review LONGTEXT NOT NULL, userId INT NOT NULL, bookId INT DEFAULT NULL, INDEX IDX_122A213FA33F7DF7 (bookId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR ADD CONSTRAINT FK_E21B8262504AA872 FOREIGN KEY (bookdto_id) REFERENCES `BOOK` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR ADD CONSTRAINT FK_E21B8262444A6044 FOREIGN KEY (bookauthordto_id) REFERENCES `BOOK_AUTHOR` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `BOOK_REVIEW` ADD CONSTRAINT FK_122A213FA33F7DF7 FOREIGN KEY (bookId) REFERENCES `BOOK` (id)');
        $this->addSql('ALTER TABLE ACTIVITY CHANGE title title VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR DROP FOREIGN KEY FK_E21B8262504AA872');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR DROP FOREIGN KEY FK_E21B8262444A6044');
        $this->addSql('ALTER TABLE `BOOK_REVIEW` DROP FOREIGN KEY FK_122A213FA33F7DF7');
        $this->addSql('DROP TABLE `BOOK`');
        $this->addSql('DROP TABLE BOOK_TO_AUTHOR');
        $this->addSql('DROP TABLE `BOOK_AUTHOR`');
        $this->addSql('DROP TABLE `BOOK_REVIEW`');
        $this->addSql('ALTER TABLE `ACTIVITY` CHANGE title title LONGTEXT DEFAULT NULL');
    }
}
