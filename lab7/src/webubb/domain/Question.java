package webubb.domain;

public class Question {
  private int id;
  private String question;
  private String answer1;
  private String answer2;
  private String answer3;
  private int correctAnswer;

  public Question(
      int id, String question, String answer1, String answer2, String answer3, int correctAnswer) {
    this.id = id;
    this.question = question;
    this.answer1 = answer1;
    this.answer2 = answer2;
    this.answer3 = answer3;
    this.correctAnswer = correctAnswer;
  }

  @Override
  public String toString() {
    return "Question{"
        + "id="
        + id
        + ", question='"
        + question
        + '\''
        + ", answer1='"
        + answer1
        + '\''
        + ", answer2='"
        + answer2
        + '\''
        + ", answer3='"
        + answer3
        + '\''
        + ", correctAnswer="
        + correctAnswer
        + '}';
  }

  public int getId() {
    return id;
  }

  public void setId(int id) {
    this.id = id;
  }

  public String getQuestion() {
    return question;
  }

  public void setQuestion(String question) {
    this.question = question;
  }

  public String getAnswer1() {
    return answer1;
  }

  public void setAnswer1(String answer1) {
    this.answer1 = answer1;
  }

  public String getAnswer2() {
    return answer2;
  }

  public void setAnswer2(String answer2) {
    this.answer2 = answer2;
  }

  public String getAnswer3() {
    return answer3;
  }

  public void setAnswer3(String answer3) {
    this.answer3 = answer3;
  }

  public int getCorrectAnswer() {
    return correctAnswer;
  }

  public void setCorrectAnswer(int correctAnswer) {
    this.correctAnswer = correctAnswer;
  }
}
