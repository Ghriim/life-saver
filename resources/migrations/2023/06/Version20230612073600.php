<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612073600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `BOOK_OF_USER` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', isWhishList TINYINT(1) NOT NULL, isOwned TINYINT(1) NOT NULL, isReading TINYINT(1) NOT NULL, isRead TINYINT(1) NOT NULL, isLiked TINYINT(1) NOT NULL, userId INT NOT NULL, bookId INT DEFAULT NULL, INDEX IDX_160E72AEA33F7DF7 (bookId), INDEX name_index (userId), UNIQUE INDEX search_idx (bookId, userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `BOOK_OF_USER` ADD CONSTRAINT FK_160E72AEA33F7DF7 FOREIGN KEY (bookId) REFERENCES `BOOK` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `BOOK_OF_USER` DROP FOREIGN KEY FK_160E72AEA33F7DF7');
        $this->addSql('DROP TABLE `BOOK_OF_USER`');
    }
}
