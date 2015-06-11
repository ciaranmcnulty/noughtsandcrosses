Feature: Playing the game
  In order to play with my friends
  As a player
  I should be able to send my moves to my friends

  Background:
    Given a game has already begun

  @critical
  Scenario: Can play anywhere on first move
    When I play the middle square as the "X" player
    Then the middle square should have been played with an "X"

  Scenario: Cannot play on occupied squares
    And I have played the middle square as the "X" player
    When I try to play the middle square as the "O" player
    Then I should not have been allowed to play that move
    And the middle square should not have been played by the "O" player

  Scenario: Players must alternate
    And I have played the middle square as the "X" player
    When I try to play the "centre-top" square as the "X" player
    Then I should not have been allowed to play that move
    And the "centre-top" square should not have been played by the "X" player

