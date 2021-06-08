<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 * @UniqueEntity("email", message="email deja enregistré")
 */
class Profile implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $raisonSociale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroSiret;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $categorieProfessionnelle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreSalarie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $creationEntreprise;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $geolocalisation;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $numeroTelephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userImage;




// ______________________________________________________________________
   
    /**
     * @return string[] The user roles
     */
    public function getRoles(){
        return ['ROLE_USER'];
    }

    /**
     * @return string|null The salt
     */
    public function getSalt(){
        return null;
    }

    /**
     * @return string The username
     */
    public function getUsername(){
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(){
        
    }
// ______________________________________________________________________

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(?string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    public function getNumeroSiret(): ?int
    {
        return $this->numeroSiret;
    }

    public function setNumeroSiret(?int $numeroSiret): self
    {
        $this->numeroSiret = $numeroSiret;

        return $this;
    }

    public function getCategorieProfessionnelle(): ?string
    {
        return $this->categorieProfessionnelle;
    }

    public function setCategorieProfessionnelle(?string $categorieProfessionnelle): self
    {
        $this->categorieProfessionnelle = $categorieProfessionnelle;

        return $this;
    }

    public function getNombreSalarie(): ?int
    {
        return $this->nombreSalarie;
    }

    public function setNombreSalarie(?int $nombreSalarie): self
    {
        $this->nombreSalarie = $nombreSalarie;

        return $this;
    }

    public function getCreationEntreprise(): ?string
    {
        return $this->creationEntreprise;
    }

    public function setCreationEntreprise(?string $creationEntreprise): self
    {
        $this->creationEntreprise = $creationEntreprise;

        return $this;
    }

    public function getGeolocalisation(): ?string
    {
        return $this->geolocalisation;
    }

    public function setGeolocalisation(?string $geolocalisation): self
    {
        $this->geolocalisation = $geolocalisation;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone(?string $numeroTelephone): self
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getUserImage(): ?string
    {
        return $this->userImage;
    }

    public function setUserImage(?string $userImage): self
    {
        $this->userImage = $userImage;

        return $this;
    }
}
