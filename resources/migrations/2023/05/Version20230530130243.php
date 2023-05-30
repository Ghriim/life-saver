<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530130243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ACTIVITY_CATEGORY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ACTIVITY_TYPE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title LONGTEXT NOT NULL, categotyId INT DEFAULT NULL, INDEX IDX_6897A15AB95C54AD (categotyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `ACTIVITY_TYPE` ADD CONSTRAINT FK_6897A15AB95C54AD FOREIGN KEY (categotyId) REFERENCES `ACTIVITY_CATEGORY` (id)');
        $this->addSql('ALTER TABLE ACTIVITY ADD typeId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ACTIVITY ADD CONSTRAINT FK_6A4795169BF49490 FOREIGN KEY (typeId) REFERENCES `ACTIVITY_TYPE` (id)');
        $this->addSql('CREATE INDEX IDX_6A4795169BF49490 ON ACTIVITY (typeId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ACTIVITY` DROP FOREIGN KEY FK_6A4795169BF49490');
        $this->addSql('ALTER TABLE `ACTIVITY_TYPE` DROP FOREIGN KEY FK_6897A15AB95C54AD');
        $this->addSql('DROP TABLE `ACTIVITY_CATEGORY`');
        $this->addSql('DROP TABLE `ACTIVITY_TYPE`');
        $this->addSql('DROP INDEX IDX_6A4795169BF49490 ON `ACTIVITY`');
        $this->addSql('ALTER TABLE `ACTIVITY` DROP typeId');
    }
}
