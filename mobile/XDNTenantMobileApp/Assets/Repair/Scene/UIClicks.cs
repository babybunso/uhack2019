using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class UIClicks : MonoBehaviour
{

    public InputField username, password;
    public GameObject Login, StartScan, ViewNotification, ReportChoices;
    APIServices api;

    public void Start()
    {
        api = new APIServices();
        if (PlayerPrefs.HasKey("BackToMain"))
        {
            if (PlayerPrefs.GetInt("BackToMain") == 1)
            {
                ViewNotification.SetActive(true);
                Login.SetActive(false);
                StartCoroutine(api.getCoin());
            }
        }
    }

    public void LoginUser()
    {
        Debug.Log("### Username:" + username.text);
        Debug.Log("### Password:" + password.text);
        ViewNotification.SetActive(true);
        Login.SetActive(false);
        StartCoroutine(api.getCoin());
    }
    public void LoadReadQR()
    {
        SceneManager.LoadScene("QrCodeRead");
    }

    public void LoadChoices()
    {
        ReportChoices.SetActive(true);
    }

    public void LoadRoom()
    {
        SceneManager.LoadScene("room");
    }

    public void LoadCommonArea()
    {
        SceneManager.LoadScene("hallway");
    }
}
