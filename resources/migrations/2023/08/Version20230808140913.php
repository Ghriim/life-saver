<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808140913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ROUTINE_TO_MOVEMENT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', targetReps INT DEFAULT NULL, targetWeight INT DEFAULT NULL, targetDuration INT DEFAULT NULL, targetDistance INT DEFAULT NULL, targetRest INT DEFAULT NULL, generateWarmup TINYINT(1) DEFAULT NULL, routineId INT NOT NULL, movementId INT NOT NULL, INDEX IDX_9BC2DB0A75D7307B (routineId), INDEX IDX_9BC2DB0AF125A79E (movementId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` ADD CONSTRAINT FK_9BC2DB0A75D7307B FOREIGN KEY (routineId) REFERENCES `ROUTINE` (id)');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` ADD CONSTRAINT FK_9BC2DB0AF125A79E FOREIGN KEY (movementId) REFERENCES `MOVEMENT` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP FOREIGN KEY FK_9BC2DB0A75D7307B');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP FOREIGN KEY FK_9BC2DB0AF125A79E');
        $this->addSql('DROP TABLE `ROUTINE_TO_MOVEMENT`');
    }
}
