using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class UIClicks : MonoBehaviour
{

    public InputField username, password;
    public Text likeTextNum;
    int totalLike = 1001;
    public GameObject Login, StartScan, ViewNotification, ReportChoices, Popup;
    APIServices api;

    public void Start()
    {
        if (!PlayerPrefs.HasKey("BackToMain"))
        {
            likeTextNum.text = totalLike.ToString();

            
        }
        if (PlayerPrefs.HasKey("BackToMain"))
        {
            if (PlayerPrefs.GetInt("BackToMain") == 1)
            {
                likeTextNum.text = PlayerPrefs.GetInt("totalLike").ToString();
            }
        }
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
        username.text = "";
        password.text = "";
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

    public void Logout()
    {
        PlayerPrefs.SetInt("BackToMain", 0);
        PlayerPrefs.SetInt("hasAgree", 0);
        Login.SetActive(true);
        ViewNotification.SetActive(false);
        SceneManager.LoadScene("StartScreen");
    }

    public void AgreeNotif()
    {
        Popup.SetActive(true);
        if (PlayerPrefs.HasKey("totalLike"))
        {
            int num = PlayerPrefs.GetInt("totalLike");
            num++;
            likeTextNum.text = num.ToString();
            PlayerPrefs.SetInt("totalLike", num);
        }
        if (!PlayerPrefs.HasKey("totalLike"))
        {
            totalLike++;
            likeTextNum.text = totalLike.ToString();
            PlayerPrefs.SetInt("totalLike", totalLike);
        }
        PlayerPrefs.SetInt("hasAgree", 1);
       
    }
}
