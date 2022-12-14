<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130103338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, position_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_161498D3DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `column` (id INT AUTO_INCREMENT NOT NULL, sprint_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, relation VARCHAR(255) NOT NULL, INDEX IDX_7D53877E8C24077B (sprint_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprint (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EF8055B7166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_card (user_id INT NOT NULL, card_id INT NOT NULL, INDEX IDX_6C95D41AA76ED395 (user_id), INDEX IDX_6C95D41A4ACC9A20 (card_id), PRIMARY KEY(user_id, card_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_to_project (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, user_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_64C2BF7D60322AC (role_id), INDEX IDX_64C2BF7A76ED395 (user_id), INDEX IDX_64C2BF7166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_to_sprint (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, user_id INT NOT NULL, sprint_id INT NOT NULL, INDEX IDX_C9B2D4CED60322AC (role_id), INDEX IDX_C9B2D4CEA76ED395 (user_id), INDEX IDX_C9B2D4CE8C24077B (sprint_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3DD842E46 FOREIGN KEY (position_id) REFERENCES `column` (id)');
        $this->addSql('ALTER TABLE `column` ADD CONSTRAINT FK_7D53877E8C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id)');
        $this->addSql('ALTER TABLE sprint ADD CONSTRAINT FK_EF8055B7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE user_card ADD CONSTRAINT FK_6C95D41AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_card ADD CONSTRAINT FK_6C95D41A4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_to_project ADD CONSTRAINT FK_64C2BF7D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user_to_project ADD CONSTRAINT FK_64C2BF7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_to_project ADD CONSTRAINT FK_64C2BF7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE user_to_sprint ADD CONSTRAINT FK_C9B2D4CED60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user_to_sprint ADD CONSTRAINT FK_C9B2D4CEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_to_sprint ADD CONSTRAINT FK_C9B2D4CE8C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3DD842E46');
        $this->addSql('ALTER TABLE `column` DROP FOREIGN KEY FK_7D53877E8C24077B');
        $this->addSql('ALTER TABLE sprint DROP FOREIGN KEY FK_EF8055B7166D1F9C');
        $this->addSql('ALTER TABLE user_card DROP FOREIGN KEY FK_6C95D41AA76ED395');
        $this->addSql('ALTER TABLE user_card DROP FOREIGN KEY FK_6C95D41A4ACC9A20');
        $this->addSql('ALTER TABLE user_to_project DROP FOREIGN KEY FK_64C2BF7D60322AC');
        $this->addSql('ALTER TABLE user_to_project DROP FOREIGN KEY FK_64C2BF7A76ED395');
        $this->addSql('ALTER TABLE user_to_project DROP FOREIGN KEY FK_64C2BF7166D1F9C');
        $this->addSql('ALTER TABLE user_to_sprint DROP FOREIGN KEY FK_C9B2D4CED60322AC');
        $this->addSql('ALTER TABLE user_to_sprint DROP FOREIGN KEY FK_C9B2D4CEA76ED395');
        $this->addSql('ALTER TABLE user_to_sprint DROP FOREIGN KEY FK_C9B2D4CE8C24077B');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE `column`');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE sprint');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_card');
        $this->addSql('DROP TABLE user_to_project');
        $this->addSql('DROP TABLE user_to_sprint');
    }
}
