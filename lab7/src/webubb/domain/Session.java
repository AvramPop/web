package webubb.domain;

public class Session {
  private int id;
  private int userId;
  private int questionPerPage;
  private int totalQuestions;
  private boolean alive;

  public Session(int id, int userId, int questionPerPage, int totalQuestions, boolean alive) {
    this.id = id;
    this.userId = userId;
    this.questionPerPage = questionPerPage;
    this.totalQuestions = totalQuestions;
    this.alive = alive;
  }

  @Override
  public String toString() {
    return "Session{"
        + "id="
        + id
        + ", userId="
        + userId
        + ", questionPerPage="
        + questionPerPage
        + ", totalQuestions="
        + totalQuestions
        + ", alive="
        + alive
        + '}';
  }

  public int getId() {
    return id;
  }

  public void setId(int id) {
    this.id = id;
  }

  public int getUserId() {
    return userId;
  }

  public void setUserId(int userId) {
    this.userId = userId;
  }

  public int getQuestionPerPage() {
    return questionPerPage;
  }

  public void setQuestionPerPage(int questionPerPage) {
    this.questionPerPage = questionPerPage;
  }

  public int getTotalQuestions() {
    return totalQuestions;
  }

  public void setTotalQuestions(int totalQuestions) {
    this.totalQuestions = totalQuestions;
  }

  public boolean isAlive() {
    return alive;
  }

  public void setAlive(boolean alive) {
    this.alive = alive;
  }
}
