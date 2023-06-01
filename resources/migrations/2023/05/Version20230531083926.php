<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531083926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ACTIVITY_CATEGORY CHANGE title title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ACTIVITY_TYPE CHANGE title title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE BOOK ADD isbn10 VARCHAR(255) NOT NULL, ADD isbn13 VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD numberOfPages INT DEFAULT NULL, ADD publishedDate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD704E8513A98B92 ON BOOK (isbn10)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD704E858AA0DA28 ON BOOK (isbn13)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_FD704E8513A98B92 ON `BOOK`');
        $this->addSql('DROP INDEX UNIQ_FD704E858AA0DA28 ON `BOOK`');
        $this->addSql('ALTER TABLE `BOOK` DROP isbn10, DROP isbn13, DROP description, DROP numberOfPages, DROP publishedDate');
        $this->addSql('ALTER TABLE `ACTIVITY_TYPE` CHANGE title title LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE `ACTIVITY_CATEGORY` CHANGE title title LONGTEXT NOT NULL');
    }
}
