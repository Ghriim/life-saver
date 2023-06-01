<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531085830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE BOOK_AUTHOR ADD fullName VARCHAR(255) NOT NULL, ADD openLibraryKey VARCHAR(255) NOT NULL, DROP firstName, DROP lastName');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D6C678313157D290 ON BOOK_AUTHOR (fullName)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D6C67831853B9AB2 ON BOOK_AUTHOR (openLibraryKey)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_D6C678313157D290 ON `BOOK_AUTHOR`');
        $this->addSql('DROP INDEX UNIQ_D6C67831853B9AB2 ON `BOOK_AUTHOR`');
        $this->addSql('ALTER TABLE `BOOK_AUTHOR` ADD firstName VARCHAR(255) NOT NULL, ADD lastName VARCHAR(255) NOT NULL, DROP fullName, DROP openLibraryKey');
    }
}
