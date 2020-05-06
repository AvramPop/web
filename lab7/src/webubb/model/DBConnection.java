package webubb.model;

import webubb.domain.Asset;
import webubb.domain.Question;
import webubb.domain.Session;
import webubb.domain.User;

import java.sql.*;
import java.util.ArrayList;

/** Created by forest. */
public class DBConnection {
  //    private Statement stmt;

  private String dbType;
  private String dbHost;
  private String dbPort;
  private String dbName;
  private String dbUser;
  private String dbPassword;

  public DBConnection() {
    loadDBConfiguration();
  }

  private void loadDBConfiguration() {
    dbType = "postgresql";
    dbHost = "localhost";
    dbPort = "5432";
    dbName = "wp";
    dbUser = "postgres";
    dbPassword = "admin";
  }

  private void loadDriver() {
    try {
      Class.forName("org.postgresql.Driver");
    } catch (ClassNotFoundException e) {
      System.err.println("Can’t load driver");
    }
  }

  private Connection dbConnection() {

    loadDriver();
    DriverManager.setLoginTimeout(60);
    try {
      String url =
          "jdbc:"
              + this.dbType
              + "://"
              + this.dbHost
              + ":"
              + this.dbPort
              + "/"
              + dbName
              + "?user="
              + this.dbUser
              + "&password="
              + this.dbPassword;
      return DriverManager.getConnection(url);
    } catch (SQLException e) {
      System.err.println("Cannot connect to the database: " + e.getMessage());
    }

    return null;
  }

  public User authenticate(String username, String password) {
    ResultSet rs;
    User u = null;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      String statement =
          "select * from users where username='" + username + "' and password='" + password + "'";
      rs = stmt.executeQuery(statement);
      if (rs.next()) {
        u =
            new User(
                rs.getInt("id"),
                rs.getString("username"),
                rs.getString("password"),
                rs.getInt("best"));
      }
      rs.close();
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return u;
  }

  public Session getCurrentSessionOfUser(int userId) {
    ResultSet rs;
    Session session = null;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      String statement = "select * from session where uid=" + userId + " and alive = true";
      rs = stmt.executeQuery(statement);
      if (rs.next()) {
        session =
            new Session(
                rs.getInt("id"),
                rs.getInt("uid"),
                rs.getInt("questionsPerPage"),
                rs.getInt("totalQuestions"),
                rs.getBoolean("alive"));
      }
      rs.close();
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return session;
  }

  public ArrayList<Asset> getUserAssets(int userid) {
    ArrayList<Asset> assets = new ArrayList<Asset>();
    ResultSet rs;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      rs = stmt.executeQuery("select * from assets where userid=" + userid);
      while (rs.next()) {
        assets.add(
            new Asset(
                rs.getInt("id"),
                rs.getInt("userid"),
                rs.getString("description"),
                rs.getInt("value")));
      }
      rs.close();
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return assets;
  }

  public ArrayList<Question> getAllQuestions() {
    ArrayList<Question> questions = new ArrayList<>();
    ResultSet rs;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      rs = stmt.executeQuery("select * from questions");
      while (rs.next()) {
        Question newQuestion =
            new Question(
                rs.getInt("id"),
                rs.getString("question"),
                rs.getString("answer1"),
                rs.getString("answer2"),
                rs.getString("answer3"),
                rs.getInt("correctAnswer"));
        questions.add(newQuestion);
      }
      rs.close();
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return questions;
  }

  public boolean updateAsset(Asset asset) {
    int r = 0;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      r =
          stmt.executeUpdate(
              "update assets set description='"
                  + asset.getDescription()
                  + "', value="
                  + asset.getValue()
                  + " where id="
                  + asset.getId());
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return r > 0;
  }

  public int createSession(int userId, int totalQuestions, int questionsPerPage) {
    try (Connection connection = dbConnection()) {
      PreparedStatement statement =
          connection.prepareStatement(
              "insert into session(uid, \"questionsPerPage\", \"totalQuestions\") values (?,?,?)",
              Statement.RETURN_GENERATED_KEYS);
      statement.setInt(1, userId);
      statement.setInt(2, questionsPerPage);
      statement.setInt(3, totalQuestions);
      int affectedRows = statement.executeUpdate();
      if (affectedRows > 0) {
        ResultSet generatedKeys = statement.getGeneratedKeys();
        if (generatedKeys.next()) {
          return generatedKeys.getInt(1);
        }
      } else {
        return -1;
      }
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return -1;
  }

  public boolean closeSession(int sessionId) {
    int r = 0;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      r = stmt.executeUpdate("update session set alive = false" + " where id=" + sessionId);
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return r > 0;
  }

  public boolean updateBest(int userId, int best) {
    int r = 0;
    try (Connection connection = dbConnection()) {
      Statement stmt = connection.createStatement();
      r = stmt.executeUpdate("update users set best = " + best + " where id=" + userId);
    } catch (SQLException e) {
      e.printStackTrace();
    }
    return r > 0;
  }
}
