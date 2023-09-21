<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920071653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `WARMUP_PATTERN` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', pattern VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9E06F035A3BCFC8E (pattern), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ROUTINE_TO_MOVEMENT ADD warmupPatternId INT DEFAULT NULL, DROP generateWarmup');
        $this->addSql('ALTER TABLE ROUTINE_TO_MOVEMENT ADD CONSTRAINT FK_9BC2DB0A117B1ABF FOREIGN KEY (warmupPatternId) REFERENCES `WARMUP_PATTERN` (id)');
        $this->addSql('CREATE INDEX IDX_9BC2DB0A117B1ABF ON ROUTINE_TO_MOVEMENT (warmupPatternId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP FOREIGN KEY FK_9BC2DB0A117B1ABF');
        $this->addSql('DROP TABLE `WARMUP_PATTERN`');
        $this->addSql('DROP INDEX IDX_9BC2DB0A117B1ABF ON `ROUTINE_TO_MOVEMENT`');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` ADD generateWarmup TINYINT(1) DEFAULT NULL, DROP warmupPatternId');
    }
}
