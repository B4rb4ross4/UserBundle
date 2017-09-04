<?php
namespace B4rb4ross4\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="B4rb4ross4\UserBundle\Repository\UserRepository")
 */
class User implements AdvancedUserInterface
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="username", type="string", length=255, unique=true)
   */
  private $username = '';

  /**
   * @var string
   *
   * @ORM\Column(name="password", type="string", length=255)
   */
  private $password = '';

  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=255, unique=true)
   */
  private $email = '';

  /**
   * @var bool
   *
   * @ORM\Column(name="isActive", type="boolean")
   */
  private $isActive = false;

  /**
   * @var array
   *
   * @ORM\Column(name="roles", type="array")
   */
  private $roles = array();

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="disabledAt", type="datetime", nullable=true)
   */
  private $disabledAt;

  /**
   * @var bool
   *
   * @ORM\Column(name="isExpired", type="boolean")
   */
  private $isExpired = false;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="expiredAt", type="datetime", nullable=true)
   */
  private $expiredAt;

  /**
   * @var bool
   *
   * @ORM\Column(name="isLocked", type="boolean", length=255)
   */
  private $isLocked = false;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="lockedAt", type="datetime", nullable=true)
   */
  private $lockedAt;

  /**
   * @var bool
   *
   * @ORM\Column(name="IsCredentialsExpired", type="boolean")
   */
  private $isCredentialsExpired = false;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="credentialsExpiredAt", type="datetime", nullable=true)
   */
  private $credentialsExpiredAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="lastLoginAt", type="datetime", nullable=true)
   */
  private $lastLoginAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="registeredAt", type="datetime", nullable=true)
   */
  private $registeredAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
   */
  private $updatedAt;

  /**
   * @var int
   *
   * @ORM\Column(name="loginAttempts", type="integer")
   */
  private $loginAttempts = 0;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="lastLoginAttempt", type="datetime", nullable=true)
   */
  private $lastLoginAttempt;

  /**
   * @Assert\Length(max=4096)
   */
  private $plainPassword = '';


  /**
   * Get id
   *
   * @return int|null
   */
  public function getId() : ?int
  {
    return $this->id;
  }

  /**
   * Set username
   *
   * @param string $username
   *
   * @return User
   */
  public function setUsername(string $username) : User
  {
    $this->username = $username;

    return $this;
  }

  /**
   * Get username
   *
   * @return string
   */
  public function getUsername() : string
  {
    return $this->username;
  }

  /**
   * Set password
   *
   * @param string $password
   *
   * @return User
   */
  public function setPassword(string $password) : User
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get password
   *
   * @return string
   */
  public function getPassword() : string
  {
    return $this->password;
  }

  /**
   * Get plain password
   *
   * @return string
   */
  public function getPlainPassword() : string
  {
    return $this->plainPassword;
  }

  /**
   * Set plain password
   *
   * @param string $password
   *
   * @return User
   */
  public function setPlainPassword(string $password) : User
  {
    $this->plainPassword = $password;
  }

  /**
   * Set email
   *
   * @param string $email
   *
   * @return User
   */
  public function setEmail(string $email) : User
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get email
   *
   * @return string
   */
  public function getEmail() : string
  {
    return $this->email;
  }

  /**
   * Set isActive
   *
   * @param bool $isActive
   *
   * @return User
   */
  public function setIsActive(bool $isActive) : User
  {
    $this->isActive = $isActive;

    return $this;
  }

  /**
   * Get isActive
   *
   * @return bool
   */
  public function getIsActive() : bool
  {
    return $this->isActive;
  }

  /**
   * Set isExpired
   *
   * @param bool $isExpired
   *
   * @return User
   */
  public function setIsExpired(bool $isExpired) : User
  {
    $this->isExpired = $isExpired;

    return $this;
  }

  /**
   * Get isExpired
   *
   * @return bool
   */
  public function getIsExpired() : bool
  {
    return $this->isExpired;
  }

  /**
   * Set isLocked
   *
   * @param bool $isLocked
   *
   * @return User
   */
  public function setIsLocked(bool $isLocked) : User
  {
    $this->isLocked = $isLocked;

    return $this;
  }

  /**
   * Get isLocked
   *
   * @return bool
   */
  public function getIsLocked() : bool
  {
    return $this->isLocked;
  }

  /**
   * Set isCredentialsExpired
   *
   * @param bool $isCredentialsExpired
   *
   * @return User
   */
  public function setIsCredentialsExpired(bool $isCredentialsExpired) : User
  {
    $this->isCredentialsExpired = $isCredentialsExpired;

    return $this;
  }

  /**
   * Get isCredentialsExpired
   *
   * @return bool
   */
  public function getIsCredentialsExpired() : bool
  {
    return $this->isCredentialsExpired;
  }

  /**
   * Set lastLoginAt
   *
   * @param \DateTime $lastLoginAt
   *
   * @return User
   */
  public function setLastLoginAt(\DateTime $lastLoginAt) : User
  {
    $this->lastLoginAt = $lastLoginAt;

    return $this;
  }

  /**
   * Get lastLoginAt
   *
   * @return \DateTime|null
   */
  public function getLastLoginAt() : ?\DateTime
  {
    return $this->lastLoginAt;
  }

  /**
   * Set registeredAt
   *
   * @param \DateTime $registeredAt
   *
   * @return User
   */
  public function setRegisteredAt(\DateTime $registeredAt) : User
  {
    $this->registeredAt = $registeredAt;

    return $this;
  }

  /**
   * Get registeredAt
   *
   * @return \DateTime|null
   */
  public function getRegisteredAt() : ?\DateTime
  {
    return $this->registeredAt;
  }

  /**
   * Set loginAttempts
   *
   * @param int $loginAttempts
   *
   * @return User
   */
  public function setLoginAttempts(int $loginAttempts) : User
  {
    $this->loginAttempts = $loginAttempts;

    return $this;
  }

  /**
   * Get loginAttempts
   *
   * @return int
   */
  public function getLoginAttempts() : int
  {
    return $this->loginAttempts;
  }

  /**
   * Set lastLoginAttempt
   *
   * @param \DateTime $lastLoginAttempt
   *
   * @return User
   */
  public function setLastLoginAttempt(\DateTime $lastLoginAttempt) : User
  {
    $this->lastLoginAttempt = $lastLoginAttempt;

    return $this;
  }

  /**
   * Get lastLoginAttempt
   *
   * @return \DateTime|null
   */
  public function getLastLoginAttempt() : ?\DateTime
  {
    return $this->lastLoginAttempt;
  }

  /**
   * Set disabledAt
   *
   * @param \DateTime $disabledAt
   *
   * @return User
   */
  public function setDisabledAt(\DateTime $disabledAt) : User
  {
    $this->disabledAt = $disabledAt;

    return $this;
  }

  /**
   * Get disabledAt
   *
   * @return \DateTime|null
   */
  public function getDisabledAt() : ?\DateTime
  {
    return $this->disabledAt;
  }

  /**
   * Set lockedAt
   *
   * @param \DateTime $lockedAt
   *
   * @return User
   */
  public function setLockedAt(\DateTime $lockedAt) : User
  {
    $this->lockedAt = $lockedAt;

    return $this;
  }

  /**
   * Get lockedAt
   *
   * @return \DateTime|null
   */
  public function getLockedAt() : ?\DateTime
  {
    return $this->lockedAt;
  }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt(\DateTime $updatedAt) : User
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt() : ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set expiredAt
     *
     * @param \DateTime $expiredAt
     *
     * @return User
     */
    public function setExpiredAt(\DateTime $expiredAt) : User
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * Get expiredAt
     *
     * @return \DateTime|null
     */
    public function getExpiredAt() : ?\DateTime
    {
        return $this->expiredAt;
    }

    /**
     * Set credentialsExpiredAt
     *
     * @param \DateTime $credentialsExpiredAt
     *
     * @return User
     */
    public function setCredentialsExpiredAt(\DateTime $credentialsExpiredAt) : User
    {
        $this->credentialsExpiredAt = $credentialsExpiredAt;

        return $this;
    }

    /**
     * Get credentialsExpiredAt
     *
     * @return \DateTime|null
     */
    public function getCredentialsExpiredAt() : ?\DateTime
    {
        return $this->credentialsExpiredAt;
    }

    public function isAccountNonExpired() : bool
    {
      return !$this->isExpired;
    }

    public function isAccountNonLocked() : bool
    {
      return !$this->isLocked;
    }

    public function isCredentialsNonExpired() : bool
    {
      return !$this->isCredentialsExpired;
    }

    public function isEnabled() : bool
    {
      return $this->isActive;
    }

    /**
     * @return array
     */
    public function getRoles() : array
    {
      return $this->roles;
    }

    public function getSalt() : string
    {
      return bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials() : void
    {
      // TODO: Implement eraseCredentials() method.
    }

    public function serialize() : string
    {
      return serialize(array(
                         $this->id,
                         $this->username,
                         $this->password,
                         $this->isActive
                         // see section on salt below
                         // $this->salt,
                       ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize(string $serialized) : User
    {
      list (
        $this->id,
        $this->username,
        $this->password,
        $this->isActive
        // see section on salt below
        // $this->salt
        ) = unserialize($serialized);

        return $this;
  }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles) : User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Give the user a role
     *
     * @param $role
     *
     * @return User
     */
    public function addRole(string $role) : User
    {

      if(!in_array($role, $this->roles))
      {
        $this->roles[] = $role;
      }

      return $this;
    }
}
