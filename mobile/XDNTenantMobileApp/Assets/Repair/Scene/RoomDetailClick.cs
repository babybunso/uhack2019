using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class RoomDetailClick : MonoBehaviour
{
   public void LoadMainScreen()
    {
        PlayerPrefs.SetInt("BackToMain", 1);
        SceneManager.LoadScene("StartScreen");
    }
}
