<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230730184739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `EQUIPMENT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_97FACB6C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `MOVEMENT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32EE09BB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ROUTINE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_74B326CC2B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT ADD CONSTRAINT FK_A699BD35A3326A1E FOREIGN KEY (movementdto_id) REFERENCES `MOVEMENT` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT ADD CONSTRAINT FK_A699BD35B7D19CEF FOREIGN KEY (equipmentdto_id) REFERENCES `EQUIPMENT` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT DROP FOREIGN KEY FK_A699BD35A3326A1E');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT DROP FOREIGN KEY FK_A699BD35B7D19CEF');
        $this->addSql('DROP TABLE `EQUIPMENT`');
        $this->addSql('DROP TABLE `MOVEMENT`');
        $this->addSql('DROP TABLE MOVEMENT_TO_EQUIPMENT');
        $this->addSql('DROP TABLE `ROUTINE`');
    }
}
