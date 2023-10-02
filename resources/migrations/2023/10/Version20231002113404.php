<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002113404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ACTIVITY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) DEFAULT NULL, userId INT NOT NULL, typeId INT DEFAULT NULL, INDEX IDX_6A4795169BF49490 (typeId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ACTIVITY_CATEGORY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ACTIVITY_TYPE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, categotyId INT DEFAULT NULL, INDEX IDX_6897A15AB95C54AD (categotyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `BOOK` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', isbn10 VARCHAR(255) NOT NULL, isbn13 VARCHAR(255) NOT NULL, openLibraryId VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, numberOfPages INT DEFAULT NULL, publishedDate VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT \'created\' NOT NULL, UNIQUE INDEX UNIQ_FD704E8513A98B92 (isbn10), UNIQUE INDEX UNIQ_FD704E858AA0DA28 (isbn13), UNIQUE INDEX UNIQ_FD704E8514F14819 (openLibraryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE BOOK_TO_AUTHOR (bookdto_id INT NOT NULL, bookauthordto_id INT NOT NULL, INDEX IDX_E21B8262504AA872 (bookdto_id), INDEX IDX_E21B8262444A6044 (bookauthordto_id), PRIMARY KEY(bookdto_id, bookauthordto_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `BOOK_AUTHOR` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fullName VARCHAR(255) NOT NULL, openLibraryKey VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D6C67831853B9AB2 (openLibraryKey), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `BOOK_OF_USER` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', isWishlist TINYINT(1) NOT NULL, isOwned TINYINT(1) NOT NULL, isReading TINYINT(1) NOT NULL, isRead TINYINT(1) NOT NULL, isLiked TINYINT(1) NOT NULL, userId INT NOT NULL, bookId INT DEFAULT NULL, INDEX IDX_160E72AEA33F7DF7 (bookId), INDEX name_index (userId), UNIQUE INDEX search_idx (bookId, userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `BOOK_REVIEW` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', evaluation INT NOT NULL, review LONGTEXT NOT NULL, userId INT NOT NULL, bookId INT DEFAULT NULL, INDEX IDX_122A213FA33F7DF7 (bookId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `EQUIPMENT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_97FACB6C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `EXERCISE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', targetReps INT DEFAULT NULL, targetWeight INT DEFAULT NULL, targetDuration INT DEFAULT NULL, targetDistance INT DEFAULT NULL, completedReps INT DEFAULT NULL, completedWeight INT DEFAULT NULL, completedDuration INT DEFAULT NULL, completedDistance INT DEFAULT NULL, restDuration INT DEFAULT NULL, batchId VARCHAR(255) NOT NULL, setType VARCHAR(255) NOT NULL, isCompleted TINYINT(1) DEFAULT 0 NOT NULL, workoutId INT NOT NULL, movementId INT NOT NULL, INDEX IDX_68E949501DDB178D (workoutId), INDEX IDX_68E94950F125A79E (movementId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `HYDRATION_INTAKE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', volume INT NOT NULL, summaryId INT DEFAULT NULL, INDEX IDX_7EC93636C0BC71D3 (summaryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `HYDRATION_SUMMARY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', dailyGoal INT NOT NULL, dailyProgress INT NOT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `MOOD` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', level INT NOT NULL, description LONGTEXT DEFAULT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `MOVEMENT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32EE09BB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MOVEMENT_TO_EQUIPMENT (movementdto_id INT NOT NULL, equipmentdto_id INT NOT NULL, INDEX IDX_A699BD35A3326A1E (movementdto_id), INDEX IDX_A699BD35B7D19CEF (equipmentdto_id), PRIMARY KEY(movementdto_id, equipmentdto_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ROUTINE` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `ROUTINE_TO_MOVEMENT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', targetReps INT DEFAULT NULL, targetWeight INT DEFAULT NULL, targetDuration INT DEFAULT NULL, targetDistance INT DEFAULT NULL, targetRest INT DEFAULT NULL, numberOfSets INT NOT NULL, routineId INT NOT NULL, movementId INT NOT NULL, warmupPatternId INT DEFAULT NULL, INDEX IDX_9BC2DB0A75D7307B (routineId), INDEX IDX_9BC2DB0AF125A79E (movementId), INDEX IDX_9BC2DB0A117B1ABF (warmupPatternId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `SLEEP` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', inBed DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', outOfBed DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', duration INT DEFAULT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `USER` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, settingsId INT NOT NULL, UNIQUE INDEX UNIQ_BB063BFD4AE62654 (settingsId), INDEX name_index (id), UNIQUE INDEX search_idx (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `USER_SETTINGS` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', lang VARCHAR(255) NOT NULL, weightUnit VARCHAR(255) NOT NULL, distanceUnit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `USER_SUMMARY` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', activityTracker JSON NOT NULL, bodyTracker JSON NOT NULL, hydrationTracker JSON NOT NULL, theCoach JSON NOT NULL, theLibrarian JSON NOT NULL, userId INT DEFAULT NULL, INDEX name_index (userId), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `WARMUP_PATTERN` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', pattern VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9E06F035A3BCFC8E (pattern), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `WEIGHT` (id INT AUTO_INCREMENT NOT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', weight INT NOT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `WORKOUT` (id INT AUTO_INCREMENT NOT NULL, routine_id INT DEFAULT NULL, createDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updateDate DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, plannedDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', startedDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', completedDate DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', userId INT NOT NULL, INDEX IDX_5BDA0568F27A94C7 (routine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `ACTIVITY` ADD CONSTRAINT FK_6A4795169BF49490 FOREIGN KEY (typeId) REFERENCES `ACTIVITY_TYPE` (id)');
        $this->addSql('ALTER TABLE `ACTIVITY_TYPE` ADD CONSTRAINT FK_6897A15AB95C54AD FOREIGN KEY (categotyId) REFERENCES `ACTIVITY_CATEGORY` (id)');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR ADD CONSTRAINT FK_E21B8262504AA872 FOREIGN KEY (bookdto_id) REFERENCES `BOOK` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR ADD CONSTRAINT FK_E21B8262444A6044 FOREIGN KEY (bookauthordto_id) REFERENCES `BOOK_AUTHOR` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `BOOK_OF_USER` ADD CONSTRAINT FK_160E72AEA33F7DF7 FOREIGN KEY (bookId) REFERENCES `BOOK` (id)');
        $this->addSql('ALTER TABLE `BOOK_REVIEW` ADD CONSTRAINT FK_122A213FA33F7DF7 FOREIGN KEY (bookId) REFERENCES `BOOK` (id)');
        $this->addSql('ALTER TABLE `EXERCISE` ADD CONSTRAINT FK_68E949501DDB178D FOREIGN KEY (workoutId) REFERENCES `WORKOUT` (id)');
        $this->addSql('ALTER TABLE `EXERCISE` ADD CONSTRAINT FK_68E94950F125A79E FOREIGN KEY (movementId) REFERENCES `MOVEMENT` (id)');
        $this->addSql('ALTER TABLE `HYDRATION_INTAKE` ADD CONSTRAINT FK_7EC93636C0BC71D3 FOREIGN KEY (summaryId) REFERENCES `HYDRATION_SUMMARY` (id)');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT ADD CONSTRAINT FK_A699BD35A3326A1E FOREIGN KEY (movementdto_id) REFERENCES `MOVEMENT` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT ADD CONSTRAINT FK_A699BD35B7D19CEF FOREIGN KEY (equipmentdto_id) REFERENCES `EQUIPMENT` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` ADD CONSTRAINT FK_9BC2DB0A75D7307B FOREIGN KEY (routineId) REFERENCES `ROUTINE` (id)');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` ADD CONSTRAINT FK_9BC2DB0AF125A79E FOREIGN KEY (movementId) REFERENCES `MOVEMENT` (id)');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` ADD CONSTRAINT FK_9BC2DB0A117B1ABF FOREIGN KEY (warmupPatternId) REFERENCES `WARMUP_PATTERN` (id)');
        $this->addSql('ALTER TABLE `USER` ADD CONSTRAINT FK_BB063BFD4AE62654 FOREIGN KEY (settingsId) REFERENCES `USER_SETTINGS` (id)');
        $this->addSql('ALTER TABLE `USER_SUMMARY` ADD CONSTRAINT FK_FA61532F64B64DCC FOREIGN KEY (userId) REFERENCES `USER` (id)');
        $this->addSql('ALTER TABLE `WORKOUT` ADD CONSTRAINT FK_5BDA0568F27A94C7 FOREIGN KEY (routine_id) REFERENCES `ROUTINE` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `ACTIVITY` DROP FOREIGN KEY FK_6A4795169BF49490');
        $this->addSql('ALTER TABLE `ACTIVITY_TYPE` DROP FOREIGN KEY FK_6897A15AB95C54AD');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR DROP FOREIGN KEY FK_E21B8262504AA872');
        $this->addSql('ALTER TABLE BOOK_TO_AUTHOR DROP FOREIGN KEY FK_E21B8262444A6044');
        $this->addSql('ALTER TABLE `BOOK_OF_USER` DROP FOREIGN KEY FK_160E72AEA33F7DF7');
        $this->addSql('ALTER TABLE `BOOK_REVIEW` DROP FOREIGN KEY FK_122A213FA33F7DF7');
        $this->addSql('ALTER TABLE `EXERCISE` DROP FOREIGN KEY FK_68E949501DDB178D');
        $this->addSql('ALTER TABLE `EXERCISE` DROP FOREIGN KEY FK_68E94950F125A79E');
        $this->addSql('ALTER TABLE `HYDRATION_INTAKE` DROP FOREIGN KEY FK_7EC93636C0BC71D3');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT DROP FOREIGN KEY FK_A699BD35A3326A1E');
        $this->addSql('ALTER TABLE MOVEMENT_TO_EQUIPMENT DROP FOREIGN KEY FK_A699BD35B7D19CEF');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP FOREIGN KEY FK_9BC2DB0A75D7307B');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP FOREIGN KEY FK_9BC2DB0AF125A79E');
        $this->addSql('ALTER TABLE `ROUTINE_TO_MOVEMENT` DROP FOREIGN KEY FK_9BC2DB0A117B1ABF');
        $this->addSql('ALTER TABLE `USER` DROP FOREIGN KEY FK_BB063BFD4AE62654');
        $this->addSql('ALTER TABLE `USER_SUMMARY` DROP FOREIGN KEY FK_FA61532F64B64DCC');
        $this->addSql('ALTER TABLE `WORKOUT` DROP FOREIGN KEY FK_5BDA0568F27A94C7');
        $this->addSql('DROP TABLE `ACTIVITY`');
        $this->addSql('DROP TABLE `ACTIVITY_CATEGORY`');
        $this->addSql('DROP TABLE `ACTIVITY_TYPE`');
        $this->addSql('DROP TABLE `BOOK`');
        $this->addSql('DROP TABLE BOOK_TO_AUTHOR');
        $this->addSql('DROP TABLE `BOOK_AUTHOR`');
        $this->addSql('DROP TABLE `BOOK_OF_USER`');
        $this->addSql('DROP TABLE `BOOK_REVIEW`');
        $this->addSql('DROP TABLE `EQUIPMENT`');
        $this->addSql('DROP TABLE `EXERCISE`');
        $this->addSql('DROP TABLE `HYDRATION_INTAKE`');
        $this->addSql('DROP TABLE `HYDRATION_SUMMARY`');
        $this->addSql('DROP TABLE `MOOD`');
        $this->addSql('DROP TABLE `MOVEMENT`');
        $this->addSql('DROP TABLE MOVEMENT_TO_EQUIPMENT');
        $this->addSql('DROP TABLE `ROUTINE`');
        $this->addSql('DROP TABLE `ROUTINE_TO_MOVEMENT`');
        $this->addSql('DROP TABLE `SLEEP`');
        $this->addSql('DROP TABLE `USER`');
        $this->addSql('DROP TABLE `USER_SETTINGS`');
        $this->addSql('DROP TABLE `USER_SUMMARY`');
        $this->addSql('DROP TABLE `WARMUP_PATTERN`');
        $this->addSql('DROP TABLE `WEIGHT`');
        $this->addSql('DROP TABLE `WORKOUT`');
    }
}
