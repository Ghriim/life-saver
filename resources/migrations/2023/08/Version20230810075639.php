<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810075639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `EXERCISE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', targetReps INT DEFAULT NULL, targetWeight INT DEFAULT NULL, targetDuration INT DEFAULT NULL, targetDistance INT DEFAULT NULL, completedReps INT DEFAULT NULL, completedWeight INT DEFAULT NULL, completedDuration INT DEFAULT NULL, completedDistance INT DEFAULT NULL, restDuration INT DEFAULT NULL, workoutId INT NOT NULL, movementId INT NOT NULL, INDEX IDX_68E949501DDB178D (workoutId), INDEX IDX_68E94950F125A79E (movementId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `WORKOUT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, plannedDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', startedDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', completedDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `EXERCISE` ADD CONSTRAINT FK_68E949501DDB178D FOREIGN KEY (workoutId) REFERENCES `WORKOUT` (id)');
        $this->addSql('ALTER TABLE `EXERCISE` ADD CONSTRAINT FK_68E94950F125A79E FOREIGN KEY (movementId) REFERENCES `MOVEMENT` (id)');
        $this->addSql('DROP INDEX UNIQ_74B326CC2B36786B ON ROUTINE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `EXERCISE` DROP FOREIGN KEY FK_68E949501DDB178D');
        $this->addSql('ALTER TABLE `EXERCISE` DROP FOREIGN KEY FK_68E94950F125A79E');
        $this->addSql('DROP TABLE `EXERCISE`');
        $this->addSql('DROP TABLE `WORKOUT`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_74B326CC2B36786B ON `ROUTINE` (title)');
    }
}
