<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511145139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ACTIVITY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title LONGTEXT NOT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `HYDRATION_INTAKE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', volume INT NOT NULL, summaryId INT DEFAULT NULL, INDEX IDX_7EC93636C0BC71D3 (summaryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `HYDRATION_SUMMARY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', dailyGoal INT NOT NULL, dailyProgress INT NOT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `MOOD` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', level INT NOT NULL, description LONGTEXT DEFAULT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `SLEEP` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', inBed DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', outOfBed DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', duration INT DEFAULT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `WEIGHT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', weight INT NOT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `HYDRATION_INTAKE` ADD CONSTRAINT FK_7EC93636C0BC71D3 FOREIGN KEY (summaryId) REFERENCES `HYDRATION_SUMMARY` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `HYDRATION_INTAKE` DROP FOREIGN KEY FK_7EC93636C0BC71D3');
        $this->addSql('DROP TABLE `ACTIVITY`');
        $this->addSql('DROP TABLE `HYDRATION_INTAKE`');
        $this->addSql('DROP TABLE `HYDRATION_SUMMARY`');
        $this->addSql('DROP TABLE `MOOD`');
        $this->addSql('DROP TABLE `SLEEP`');
        $this->addSql('DROP TABLE `WEIGHT`');
    }
}
