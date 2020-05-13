package webubb.domain;

/** Created by forest. */
public class User {
  private int id;
  private String username;
  private String password;
  private int best;

  public User(int id, String username, String password, int best) {
    this.id = id;
    this.username = username;
    this.password = password;
    this.best = best;
  }

  public int getId() {
    return id;
  }

  public void setId(int id) {
    this.id = id;
  }

  public String getUsername() {
    return username;
  }

  public void setUsername(String username) {
    this.username = username;
  }

  public String getPassword() {
    return password;
  }

  public int getBest() {
    return best;
  }

  @Override
  public String toString() {
    return "User{"
        + "id="
        + id
        + ", username='"
        + username
        + '\''
        + ", password='"
        + password
        + '\''
        + ", best="
        + best
        + '}';
  }

  public void setBest(int best) {
    this.best = best;
  }

  public void setPassword(String password) {
    this.password = password;
  }
}