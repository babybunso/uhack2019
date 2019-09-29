namespace DigiFrame {

    using System.Collections.Generic;
    using System.Collections;
    using UnityEngine;
    using UnityEngine.EventSystems;
    using UnityEngine.UI;
    using UnityEngine.SceneManagement;

    public class Item : UIBehaviour, IDynamicScrollViewItem 
    {

        private readonly Color[] colors = new Color[] {
		    Color.cyan,
		    Color.green,
	    };

        public Image icon;
        public Text reportDetailsText;

        public Button reportBtn;

        private bool isDone = false;



        //void LoadDestinationScene()
        //{
        //    SceneManager.LoadScene("DestinationVideo");
        //}
        public IEnumerator LoadReports(int index)
        { //Request the API

            ParseJob job = new ParseJob();
            if (PlayerPrefs.HasKey("BackToMain"))
            {
                if (PlayerPrefs.GetInt("BackToMain") == 1)
                {
                    job.InData = Resources.Load<TextAsset>("reports2").text;
                }
                else if (PlayerPrefs.GetInt("BackToMain") == 0)
                {
                    job.InData = Resources.Load<TextAsset>("reports").text;
                }
            }
            else
            {
                job.InData = Resources.Load<TextAsset>("reports").text;
            }
            
            job.Start();

            yield return StartCoroutine(job.WaitFor());

            IDictionary response = (IDictionary)((IDictionary)job.OutData);
            IList results = (IList)response["results"];
            IDictionary report = ((IDictionary)results[index]);
            string imageName = report["image_url"].ToString();
            this.icon.sprite = Resources.Load<Sprite>(imageName);
            this.reportDetailsText.text = report["reportDetails"].ToString(); 
            Button loadDestinationBtn = this.reportBtn.GetComponent<Button>();
            //loadDestinationBtn.onClick.AddListener(LoadDestinationScene);

        }
        

        public void onUpdateItem( int index ) 
        {
            StartCoroutine(LoadReports(index));
        }
    }
}