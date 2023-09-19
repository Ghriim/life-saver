<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919190420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE EXERCISE ADD batchId VARCHAR(255) NOT NULL, ADD setType VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ROUTINE_TO_MOVEMENT ADD numberOfSets INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `EXERCISE` DROP batchId, DROP setType');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP numberOfSets');
    }
}
