<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119065507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE static_text_type (id INT AUTO_INCREMENT NOT NULL, photo1 VARCHAR(255) DEFAULT NULL, photo2 VARCHAR(255) DEFAULT NULL, photo3 VARCHAR(255) DEFAULT NULL, photo4 VARCHAR(255) DEFAULT NULL, photo5 VARCHAR(255) DEFAULT NULL, photo6 VARCHAR(255) DEFAULT NULL, photo7 VARCHAR(255) DEFAULT NULL, photo8 VARCHAR(255) DEFAULT NULL, photo9 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE static_text_type');
    }
}
