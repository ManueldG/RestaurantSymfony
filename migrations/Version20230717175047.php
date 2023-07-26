<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717175047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398157EBC1A');
        $this->addSql('DROP INDEX IDX_F5299398157EBC1A ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE dish_id_id dish_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('CREATE INDEX IDX_F5299398148EB0CB ON `order` (dish_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398148EB0CB');
        $this->addSql('DROP INDEX IDX_F5299398148EB0CB ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE dish_id dish_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398157EBC1A FOREIGN KEY (dish_id_id) REFERENCES dish (id)');
        $this->addSql('CREATE INDEX IDX_F5299398157EBC1A ON `order` (dish_id_id)');
    }
}
