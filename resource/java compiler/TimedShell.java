
public class TimedShell extends Thread {
	
	Language parent;
	Process p;
	long time;
	
	public TimedShell(Language parent, Process p, long time){
		this.parent = parent;
		this.p = p;
		this.time = time;
	}
	
	// Sleep until timeout and then terminate the process
	public void run() {
		try {
			sleep(time * 1000);
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		try {
			p.exitValue();
			///this returs the exit value of subprocess but we are exploiting the fact 
			///that if the subprocess represented by this Process object has not yet terminated
			///IllegalThreadStateException is thrown
			parent.timedout = false;
		} catch (IllegalThreadStateException e) {
			parent.timedout = true;
			p.destroy();
		}
	}
}