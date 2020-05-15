<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429153608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE camion (id INT AUTO_INCREMENT NOT NULL, modele_id INT NOT NULL, no_immatric VARCHAR(255) NOT NULL, date_achat DATE NOT NULL, INDEX IDX_5DD566ECAC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camion_employe (camion_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_3225FDD33A706D3 (camion_id), INDEX IDX_3225FDD31B65292 (employe_id), PRIMARY KEY(camion_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre_traitement (id INT AUTO_INCREMENT NOT NULL, nom_centre VARCHAR(255) NOT NULL, no_rue_centre VARCHAR(255) DEFAULT NULL, rue_centre VARCHAR(255) NOT NULL, c_postal_centre VARCHAR(255) NOT NULL, ville_centre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre_traitement_type_dechet (centre_traitement_id INT NOT NULL, type_dechet_id INT NOT NULL, INDEX IDX_907B5E83B91312F4 (centre_traitement_id), INDEX IDX_907B5E83B93D2352 (type_dechet_id), PRIMARY KEY(centre_traitement_id, type_dechet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, date_embauche DATE NOT NULL, salaire DOUBLE PRECISION NOT NULL, INDEX IDX_F804D3B9DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, nom_fonction VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom_marque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, nom_modele VARCHAR(255) NOT NULL, INDEX IDX_100285584827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournee (id INT AUTO_INCREMENT NOT NULL, camion_id INT NOT NULL, employe_id INT NOT NULL, date_tournee DATETIME NOT NULL, INDEX IDX_EBF67D7E3A706D3 (camion_id), INDEX IDX_EBF67D7E1B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournee_centre_traitement (tournee_id INT NOT NULL, centre_traitement_id INT NOT NULL, INDEX IDX_D60B4BE5F661D013 (tournee_id), INDEX IDX_D60B4BE5B91312F4 (centre_traitement_id), PRIMARY KEY(tournee_id, centre_traitement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournee_demande (tournee_id INT NOT NULL, demande_id INT NOT NULL, INDEX IDX_FA76085BF661D013 (tournee_id), INDEX IDX_FA76085B80E95E18 (demande_id), PRIMARY KEY(tournee_id, demande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_dechet (id INT AUTO_INCREMENT NOT NULL, niv_danger VARCHAR(255) NOT NULL, nomtypedechet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_dechet_demande (type_dechet_id INT NOT NULL, demande_id INT NOT NULL, INDEX IDX_197144F5B93D2352 (type_dechet_id), INDEX IDX_197144F580E95E18 (demande_id), PRIMARY KEY(type_dechet_id, demande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE camion ADD CONSTRAINT FK_5DD566ECAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE camion_employe ADD CONSTRAINT FK_3225FDD33A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE camion_employe ADD CONSTRAINT FK_3225FDD31B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE centre_traitement_type_dechet ADD CONSTRAINT FK_907B5E83B91312F4 FOREIGN KEY (centre_traitement_id) REFERENCES centre_traitement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE centre_traitement_type_dechet ADD CONSTRAINT FK_907B5E83B93D2352 FOREIGN KEY (type_dechet_id) REFERENCES type_dechet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9DD842E46 FOREIGN KEY (position_id) REFERENCES fonction (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE tournee ADD CONSTRAINT FK_EBF67D7E3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('ALTER TABLE tournee ADD CONSTRAINT FK_EBF67D7E1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE tournee_centre_traitement ADD CONSTRAINT FK_D60B4BE5F661D013 FOREIGN KEY (tournee_id) REFERENCES tournee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournee_centre_traitement ADD CONSTRAINT FK_D60B4BE5B91312F4 FOREIGN KEY (centre_traitement_id) REFERENCES centre_traitement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournee_demande ADD CONSTRAINT FK_FA76085BF661D013 FOREIGN KEY (tournee_id) REFERENCES tournee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournee_demande ADD CONSTRAINT FK_FA76085B80E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_dechet_demande ADD CONSTRAINT FK_197144F5B93D2352 FOREIGN KEY (type_dechet_id) REFERENCES type_dechet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_dechet_demande ADD CONSTRAINT FK_197144F580E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE camion_employe DROP FOREIGN KEY FK_3225FDD33A706D3');
        $this->addSql('ALTER TABLE tournee DROP FOREIGN KEY FK_EBF67D7E3A706D3');
        $this->addSql('ALTER TABLE centre_traitement_type_dechet DROP FOREIGN KEY FK_907B5E83B91312F4');
        $this->addSql('ALTER TABLE tournee_centre_traitement DROP FOREIGN KEY FK_D60B4BE5B91312F4');
        $this->addSql('ALTER TABLE camion_employe DROP FOREIGN KEY FK_3225FDD31B65292');
        $this->addSql('ALTER TABLE tournee DROP FOREIGN KEY FK_EBF67D7E1B65292');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9DD842E46');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('ALTER TABLE camion DROP FOREIGN KEY FK_5DD566ECAC14B70A');
        $this->addSql('ALTER TABLE tournee_centre_traitement DROP FOREIGN KEY FK_D60B4BE5F661D013');
        $this->addSql('ALTER TABLE tournee_demande DROP FOREIGN KEY FK_FA76085BF661D013');
        $this->addSql('ALTER TABLE centre_traitement_type_dechet DROP FOREIGN KEY FK_907B5E83B93D2352');
        $this->addSql('ALTER TABLE type_dechet_demande DROP FOREIGN KEY FK_197144F5B93D2352');
        $this->addSql('DROP TABLE camion');
        $this->addSql('DROP TABLE camion_employe');
        $this->addSql('DROP TABLE centre_traitement');
        $this->addSql('DROP TABLE centre_traitement_type_dechet');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE tournee');
        $this->addSql('DROP TABLE tournee_centre_traitement');
        $this->addSql('DROP TABLE tournee_demande');
        $this->addSql('DROP TABLE type_dechet');
        $this->addSql('DROP TABLE type_dechet_demande');
    }
}
