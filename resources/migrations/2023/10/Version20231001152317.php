<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001152317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `USER_SETTINGS` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', lang VARCHAR(255) NOT NULL, weightUnit VARCHAR(255) NOT NULL, distanceUnit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE USER ADD settingsId INT DEFAULT NULL');
        $this->addSql('ALTER TABLE USER ADD CONSTRAINT FK_BB063BFD4AE62654 FOREIGN KEY (settingsId) REFERENCES `USER_SETTINGS` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BB063BFD4AE62654 ON USER (settingsId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `USER` DROP FOREIGN KEY FK_BB063BFD4AE62654');
        $this->addSql('DROP TABLE `USER_SETTINGS`');
        $this->addSql('DROP INDEX UNIQ_BB063BFD4AE62654 ON `USER`');
        $this->addSql('ALTER TABLE `USER` DROP settingsId');
    }
}
