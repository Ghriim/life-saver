<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001151603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE USER_SUMMARY ADD activityTracker JSON NOT NULL, ADD bodyTracker JSON NOT NULL, ADD hydrationTracker JSON NOT NULL, ADD theCoach JSON NOT NULL, ADD theLibrarian JSON NOT NULL, DROP hydration, DROP training');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `USER_SUMMARY` ADD hydration JSON NOT NULL, ADD training JSON NOT NULL, DROP activityTracker, DROP bodyTracker, DROP hydrationTracker, DROP theCoach, DROP theLibrarian');
    }
}
