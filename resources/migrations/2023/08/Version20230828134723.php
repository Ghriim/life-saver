<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828134723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE WORKOUT ADD routine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE WORKOUT ADD CONSTRAINT FK_5BDA0568F27A94C7 FOREIGN KEY (routine_id) REFERENCES `ROUTINE` (id)');
        $this->addSql('CREATE INDEX IDX_5BDA0568F27A94C7 ON WORKOUT (routine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `WORKOUT` DROP FOREIGN KEY FK_5BDA0568F27A94C7');
        $this->addSql('DROP INDEX IDX_5BDA0568F27A94C7 ON `WORKOUT`');
        $this->addSql('ALTER TABLE `WORKOUT` DROP routine_id');
    }
}
